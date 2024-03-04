const openAccordion = (e)=>{
    const accordionContents = document.querySelectorAll('.accordion-content');
    for(let i = 0; i < accordionContents.length; i++){
        if(!accordionContents[i].classList.contains('overflow-hidden') && accordionContents[i].getAttribute('data-toggle') != e.currentTarget.id){
            accordionContents[i].classList.add('overflow-hidden');
            accordionContents[i].classList.add('max-h-0');
            accordionContents[i].classList.remove('max-h-96');
            accordionContents[i].classList.remove('p-4');
        }
    }

    for(let i = 0; i < accordionContents.length; i++){
        if(accordionContents[i].getAttribute('data-toggle') == e.currentTarget.id){
            const accordionContent = accordionContents[i];
            accordionContent.classList.toggle('overflow-hidden')
            accordionContent.classList.toggle('max-h-0')
            accordionContent.classList.toggle('max-h-96')
            accordionContent.classList.toggle('p-4');
        }
    }
}
