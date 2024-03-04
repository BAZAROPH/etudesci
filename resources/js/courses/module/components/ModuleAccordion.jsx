import React, {useState} from 'react'

export default function ModuleAccordion(props) {
    const [classes, setClasses]  = useState('overflow-hidden max-h-0')
    const displayed = ()=>{
        if(classes.indexOf('pt-4') > -1){
            setClasses('overflow-hidden max-h-0');
        }else{
            setClasses('max-h-96 pt-4');
        }
    }

    return (
        <div className='rounded-lg border'>
            <div className={`text-xl font-semibold transition-all duration-500 ease-in-out ${props.finished ? 'text-white bg-etudes-orange' : props.active ? 'bg-etudes-blue text-white' : 'bg-gray-200 text-gray-600'} py-4 px-2  rounded-lg flex items-center justify-between cursor-pointer select-none`} onClick={()=>{displayed()}}>
                <span>Module {props.number}</span>
                <i className="icofont-thin-down"></i>
            </div>
            <div className={`duration-1000 transition-all ease-in-out ${classes}`}>
                {props.children}
            </div>
        </div>
    )
}
