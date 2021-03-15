const xhr=new XMLHttpRequest;
clicked=false;
let page_name=document.querySelector('.page_name').value;
document.querySelector('.q'+page_name).classList.add('act');
// document.querySelectorAll('.nav-link').forEach(ln=>{
//     ln.classList.remove('act');
// })
menu=document.querySelectorAll('.menu-control');
if(menu!=null){
menu.forEach(element=>{
element.addEventListener('click',e=>{
    if(clicked){
        document.querySelector('.nav-right').style.display='none';
        document.querySelector('.menu').style.display='block';
        document.querySelector('.cancel').style.display='none';
        document.querySelector('.nav').style.boxShadow=null;
        clicked=false
    }else{
        document.querySelector('.nav-right').style.display='block';
        document.querySelector('.navbar').style.background='#fff'
        document.querySelector('.menu').style.display='none';
        document.querySelector('.cancel').style.display='block';
        clicked=true;
        document.querySelector('.nav').style.boxShadow='1px 1px 8px #a0afbe';
    }

    });

});}

document.querySelectorAll('.more-port').forEach(btn=>{
    btn.addEventListener('click',e=>{
     console.log('....................')
    window.project_id2=btn.getAttribute('project_id').replace('id_','')
        console.log(window.project_id2)
        let target=btn.getAttribute('id')
        document.querySelector('.'+target).style.display='block';
        request_data('post','/api/features',{project_id:window.project_id2},(res)=>{
            let del=btn.classList.contains('edit_project');
            if(del){
                let form=document.querySelector('.edit-port-wrapper .port-form');
                form.querySelector('.pro_title').value=res.project.title;
                form.querySelector('.pro_short_description').value=res.project.short_description
                form.querySelector('.pro_description').value=res.project.description
            }
            show_features(res.features,document.querySelector('.'+target),!del);

        })
    })
})

document.querySelectorAll('.close-port').forEach(btn=>{
    btn.addEventListener('click',e=>{
        document.querySelectorAll('.portfolio-more').forEach(tab=>{
            tab.style.display='none'
        })
    })
})

document.querySelector('body').addEventListener('wheel',e=>{
    let sc=window.scrollY
//   if(sc>50){
//     document.querySelector('.navbar').style.background='rgba(255,255,255,0.6)'
//     document.querySelector('.navbar').style.backdropFilter='p'
//     // document.querySelector('.navbar').style.boxShadow='1px 1px 10px #fff'
//   }else if(sc<50){
//     document.querySelector('.navbar').style.background='transparent'
//   }
})

if(page_name=='home'){

window._ = new Glider(document.querySelector('.glider'), {
    slidesToShow: 1, //'auto',
    slidesToScroll: 1,
    itemWidth: 150,
    draggable: true,
    scrollLock: false,
    dots: '#dots',
    rewind: true,
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    },
    responsive: [
        {
            breakpoint: 800,
            settings: {
                slidesToScroll: 'auto',
                itemWidth: 300,
                slidesToShow: 'auto',
                exactWidth: true
            }
        },
        {
            breakpoint: 700,
            settings: {
                slidesToScroll: 4,
                slidesToShow: 4,
                dots: false,
                arrows: false,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToScroll: 3,
                slidesToShow: 3
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToScroll: 2,
                slidesToShow: 2,
                dots: false,
                arrows: false,
                scrollLock: true
            }
        }
    ]
});
}

//login

if(page_name=='login'){
let login_page='su';

document.querySelector('.login-tog').addEventListener('click',e=>{
    if(login_page=='su'){
        e.currentTarget.textContent='Sign Up'
        login_page='si'
        document.querySelector('.login').style.display=null
        document.querySelector('.signup').style.display='none'
        document.querySelector('.username').style.display='none'
    }else{
        login_page='su'
        document.querySelector('.login').style.display='none'
        document.querySelector('.signup').style.display=null
        document.querySelector('.username').style.display='block'
        e.currentTarget.textContent='Sign In'

    }

})
 document.querySelector('.nav-right .btn-wrapper').style.display='none'
}else{
    document.querySelector('.nav-right .btn-wrapper').style.display=null
}

if(page_name=='dash'){
    document.querySelector('footer').style.display='none'
    document.querySelector('.navbar').style.display='none'

}
function request_data(method,url,data,callback){
    xhr.open(method,url,true);
    xhr.responseType='json',
    xhr.setRequestHeader('the_id',document.querySelector('.the_id').classList)
    xhr.setRequestHeader('content-Type','application/json; charset=utf-8')
    method=='post' || method=='delete'?xhr.send(JSON.stringify(data)):xhr.send();
    xhr.onload=()=>{
        let res=xhr.response;
        callback(res)
    }
}
if(page_name=='home'){
    document.querySelector('.add_newsletter').addEventListener('click',e=>{
        data={
            email:document.querySelector('.news-email').value
        }
        console.log(data)
        request_data('post','/api/newsletter',data,(res)=>{
            if(res.subscribed){
                console.log(res)
                swal({
                    title:'Subscribed',
                    text:'You have subscribed to our newsletter',
                    danger_mode:true,
                    icon:'success'
                })
            }
        })
    })
}


function show_features(data,parent,hide=false){
    console.log(data)
    let features=parent.querySelector('.features');
    features.innerHTML='';
    data.forEach(f=>{
        let feature=`<div class="landing-par"><img src="/images/icons8_checked_checkbox_125px.png" alt="">${f.title} </div>
        <div class="mission">${f.description}</div>
        `
        if(!hide) feature+=` <button class="btn danger-btn " id="f_id_${f.id}" onclick="delete_feature(this)">delete</button>`
        let div= document.createElement('div')
        div.classList.add('feature');
        div.innerHTML=feature;
        features.appendChild(div)
    })
}

if(page_name=='contacts'){
    document.querySelector('.send_message').addEventListener('click',e=>{
        let data={
            message:document.querySelector('#mess_message').value,
            subject:document.querySelector('#mess_subject').value,
            name:document.querySelector('#mess_name').value,
            email:document.querySelector('#mess_email').value,

        }
        request_data('post','/api/send_message',data,res=>{
            if(res.saved){
                swal({
                    title:'Message sent',
                    text:'Your message has been sent ,we will email you shortly',
                    danger_mode:true,
                    icon:'success'
                });
                document.querySelector('#mess_message').value='';
                document.querySelector('#mess_subject').value='';
                document.querySelector('#mess_name').value='';
                document.querySelector('#mess_email').value='';
            }
        });
    })
}
