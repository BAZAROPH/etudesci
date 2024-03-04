const openTabs = (e)=>{
    const tabContents = document.querySelectorAll('.tab-content');
    for(let i = 0; i < tabContents.length; i++){
        if(!tabContents[i].classList.contains('hidden')){
            tabContents[i].classList.add('hidden')
        }
        if(document.getElementById(tabContents[i].getAttribute('data-target')).classList.contains('tab-active')){
            document.getElementById(tabContents[i].getAttribute('data-target')).classList.remove('tab-active')
        }
    }

    for(let i = 0; i < tabContents.length; i++){
        if(tabContents[i].getAttribute('data-target') == e.currentTarget.id){
            tabContents[i].classList.remove('hidden');
            document.getElementById(tabContents[i].getAttribute('data-target')).classList.add('tab-active');
            i = tabContents.length;
        }
    }
    }
document.querySelector('.default-active').click();
