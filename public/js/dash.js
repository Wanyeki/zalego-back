
document.querySelectorAll('.side-item').forEach(bt=>{
    bt.addEventListener('click',e=>{

        document.querySelectorAll('.window').forEach(wn=>{
            wn.style.display='none'
        })
        document.querySelectorAll('.side-item').forEach(btn=>{
            btn.classList.remove('selected')
        })
         bt.classList.add('selected')
         switch(bt.getAttribute('id')){
             case 'users':
                 request_data('get','/api/all_users',{},res=>{
                  document.querySelector('.users_table tbody').textContent=''
                    window.users=res
                     res.forEach(display_user);
                     make_selectable(document.querySelector('.users_table tbody'))
                 })
                 break;
            case 'goals':
                get_page_content('approach');
                break;
            case 'email':
                get_messages()
            break;

         }
         try {
              document.querySelector('.'+bt.getAttribute('id')).style.display='block';
         } catch (error) {
            window.location.href='/'
         }

    })
})


function display_user(user){
        tr=document.createElement('tr')
        td=document.createElement('td')
        td.textContent=user.name;
        tr.appendChild(td)

        td=document.createElement('td')
        td.textContent=user.email;
        tr.appendChild(td)

        td=document.createElement('td')
        td.textContent=user.email_verified_at==null?'No':'Yes';
        tr.appendChild(td)

        td=document.createElement('td')
        td.textContent=user.type;
        tr.appendChild(td)

        document.querySelector('.users_table tbody').appendChild(tr)

}
document.querySelector('.save_user').addEventListener('click',e=>{
    let data={
        name:document.querySelector('.usern').value,
        email:document.querySelector('.userem').value,
    }
if(data.name!='' && data.email!=''){
    request_data('post','/api/add_user',data,(res)=>{
        console.log(res)
        if(res.saved){
        document.querySelector('.users_table tbody').textContent=''
        document.querySelector('.usern').value='';
        document.querySelector('.userem').value=''
        swal({
            title:'Saved',
            text:'User saved ',
            danger_mode:true,
            icon:'success'
        })

        res.users.forEach(display_user)
        make_selectable(document.querySelector('.users_table tbody'))
        }

    })
}
})
function make_selectable(table){
    table.querySelectorAll('tr').forEach(row => {
      row.addEventListener('click',e=>{
        window.selected_email=row.querySelectorAll('td')[1].textContent
        window.selected_user=window.users.find(u=>u.email==window.selected_email)
        console.log(window.selected_user)
           table.querySelectorAll('tr').forEach(row => {
            row.style.background='#fff';
              row.style.color='#000'

         });
         row.style.background='#FE5454'
         row.style.color='#fff'
      })
    });
}

document.querySelector('.make_admin').addEventListener('click',e=>{
    request_data('post','/api/make_admin',window.selected_user,(res)=>{
        console.log(res)
        if(res.updated){
            document.querySelector('.users_table tbody').textContent=''
            swal({
                title:'Updated',
                text:'User updated ',
                danger_mode:true,
                icon:'success'
            });
            res.users.forEach(display_user);
            make_selectable(document.querySelector('.users_table tbody'))
        }
    })
})


document.querySelector('.delete_user').addEventListener('click',e=>{
    request_data('post','/api/delete_user',window.selected_user,(res)=>{
        if(res.deleted){
            document.querySelector('.users_table tbody').textContent=''
            swal({
                title:'Deleted',
                text:'User deleted ',
                danger_mode:true,
                icon:'success'
            });
           res.users.forEach(display_user)
           make_selectable(document.querySelector('.users_table tbody'))

        }
    })
})


document.querySelectorAll('.delete_project').forEach(btn=>{
    btn.addEventListener('click',e=>{

        request_data('post','/api/delete_project',{id:btn.getAttribute('id').replace('id_','')},(res)=>{
            if(res.deleted){
                let parent=btn.parentNode.parentNode;
                parent.style.display='none'
                swal({
                    title:'Deleted',
                    text:'Project deleted',
                    danger_mode:true,
                    icon:'success'
                });
            }
        })
    })
})


document.querySelectorAll('.delete_partner').forEach(btn=>{
    btn.addEventListener('click',e=>{

        request_data('post','/api/delete_partner',{id:btn.getAttribute('id').replace('id_','')},(res)=>{
            if(res.deleted){
                let parent=btn.parentNode;
                parent.style.display='none'
                swal({
                    title:'Deleted',
                    text:'Project deleted',
                    danger_mode:true,
                    icon:'success'
                });
            }
        })
    })
})

window.project_id=null;
// document.querySelectorAll('.edit_project').forEach(btn=>btn.addEventListener('click',e=>{
//     window.project_id=e.currentTarget.getAttribute('project_id').replace('id_','')
//     request_data('post','/api/features',{project_id:window.project_id},(res)=>{
//         show_features(res.features,document.querySelector('.features_preview'));
//         console.table(res.project)
//          let form=document.querySelector('.edit-port-wrapper .port-form');

//          form.querySelector('.pro_title').value=res.project.title;
//          form.querySelector('.pro_short_description').value=res.project.short_description
//          form.querySelector('.pro_description').value=res.project.description
//     })


// }));

document.querySelector('.add_feature').addEventListener('click',e=>{
    let data={
        title:document.querySelector('.feature_title').value,
        description:document.querySelector('.feature_description').value,
        project_id:window.project_id

    }
    console.log(data)
    request_data('post','/api/add_feature',data,(res)=>{

        if(res.saved){
            show_features(res.features,document.querySelector('.features_preview'))
            swal({
                title:'Saved',
                text:'Project Feature saved',
                danger_mode:true,
                icon:'success'
            });
            document.querySelector('.feature_title').value='';
             document.querySelector('.feature_description').value='';
        }
    })
})




function delete_feature(elm){
    let id=elm.getAttribute('id').replace('f_id_','');

    request_data('post','/api/delete_feature',{feature_id:id,project_id:window.project_id},(res)=>{
        if(res.deleted){
            swal({
                title:'Deleted',
                text:'Project Feature deleted',
                danger_mode:true,
                icon:'success'
            });

            show_features(res.features,document.querySelector('.features_preview'))
        }
    })
}

function get_page_content(type){
    let data={
        type:type
    }
let content_sect=document.querySelector('.dash-contents')
let img=document.createElement('img');
img.setAttribute('src','/images/loader2.gif');
content_sect.innerHTML='';
content_sect.appendChild(img)
request_data('post','/api/get_content',data,res=>{
content_sect.innerHTML='';
    show_content(res)
    })
}

function show_content(res){
    let content_sect=document.querySelector('.dash-contents')
    let i=1;
    let data={
        type:document.querySelector('.goal_type').value
    }
    res.content.forEach(dt=>{
        let template='';
        let div=document.createElement('div');
        div.classList.add('step');
        switch(data.type){
            case 'goal':
                template=` <div class="list">
                <img src="/images/icons8_checked_checkbox_125px.png" style="height: 50px;" alt="">
                <div class="mission">${dt.description}</div>
                 </div>`;
                 div.style.height='200px'

                break;
            case 'approach':
                template=` <img src="/images/icons8_cloud_development_50px.png" alt="" class="step-icon">
                <div class="top-landing-text">${dt.title}</div>
                <p class="mission" style="overflow: auto">${dt.description}
                     <div class="arrow">
                      <div class="step_number">${i}</div>
                    </div>
                  </p>`
                 div.style.height='300px'

                break;
             case 'capability':
                 template=` <div class="step_head">
                 <img src="${dt.icon}" alt="" class="cap_icon">
                 <div class="top-landing-text">${dt.title}</div>
                 </div><div class="mission">${dt.description}</div>`
                 div.style.height='370px'

                break;
            case 'sets':
                template=` <img src="${dt.icon}" alt="" class="step-icon">
                <div class="top-landing-text">${dt.title}</div>
                <p class="mission">
                ${dt.description}

                </p>`
                div.style.height='360px'

                break;
        }

        template+=`<button class="btn danger-btn" onclick="delete_content(this)"  id="conte_${dt.id}" >delete</button>`


        div.innerHTML=template;
        content_sect.appendChild(div)
        i++;
    })
}


document.querySelector('.goal_type').addEventListener('change',e=>{
    let val=e.currentTarget.value;
    if(val=='goal'){
        document.querySelector('.cont_description').style.display='none';
        document.querySelector('.cont_file').style.display='none'
    }else if(val=='approach'){
        document.querySelector('.cont_file').style.display='none'
    }
    else{
        document.querySelector('.cont_description').style.display=null;
        document.querySelector('.cont_file').style.display=null
    }

    get_page_content(val);
})


function delete_content(elm){
    data={
        id:elm.getAttribute('id').replace('conte_',''),
        type:document.querySelector('.goal_type').value
    }
    let content_sect=document.querySelector('.dash-contents')
    request_data('post','/api/delete_content',data,res=>{
        if(res.deleted){
            console.log(res)
            content_sect.innerHTML='';
           show_content(res)
            swal({
                title:'Deleted',
                text:'Content deleted ',
                danger_mode:true,
                icon:'success'
            })

        }
    })
}

function get_messages(){
    request_data('post','/api/messages',{},res=>{
        show_messages(res.messages)
    })
}
window.messages=[]
function show_messages(res,id=null){
    let message_sect=document.querySelector('.conts')
    message_sect.textContent=''
    window.messages=res;

    res.forEach(message=>{
        let template=`
        <div class="li_wrapper">
    <div class="av">
    <div class="avatar">
        <img src="/images/avatar.png" alt="">
    </div></div>
    <div class="av_left">
        <div class="subject">${message.name}</div>
        <div class="av_bottom">${message.subject.slice(0,30)}..</div>
    </div>
    </div>

    <div class="av">
    <img src="/images/icons8_delete_64px.png" width="30" onclick="delete_message(${message.id})">
    </div>
    `

div=document.createElement('div')
div.classList.add('conta');
if(message.status=='0')div.classList.add('not_read');
div.setAttribute('id','conta_'+message.id)
if(id==message.id){
 div.classList.add('sell')
}
div.innerHTML=template;

message_sect.appendChild(div)

    })
    add_listener_to_conta()
}

function add_listener_to_conta(){
document.querySelectorAll('.conta').forEach(c=>c.addEventListener('click',e=>{

    let id=e.currentTarget.getAttribute('id').replace('conta_','');
    let msg=window.messages.find(m=>m.id==id);
    document.querySelectorAll('.conta').forEach(c=>c.classList.remove('sell'))
    e.currentTarget.classList.add('sell');
    document.querySelector('.av_email').textContent=msg.email;
    document.querySelector('.av_name').textContent=msg.name;
    document.querySelector('.messages_top').style.display='block';
    document.querySelector('.message_body').style.display='block';
    document.querySelector('.nw').textContent='Reply to email'
    request_data('post','/api/read_message',{id:id},res=>{
        if(res.updated){
            show_messages(res.messages,res.id);
        }
    })
    document.querySelector('.message_body .titl').textContent=msg.subject;
    document.querySelector('.message_body .body').textContent=msg.message;

}));
}

function delete_message(id){
    document.querySelector('.messages_top').style.display='none';
    document.querySelector('.message_body').style.display='none';
    request_data('post','/api/delete_message',{id:id},res=>{
        if(res.deleted){
            swal({
                title:'Deleted',
                text:'message deleted ',
                danger_mode:true,
                icon:'success'
            })
            show_messages(res.messages)
        }
    })
}
