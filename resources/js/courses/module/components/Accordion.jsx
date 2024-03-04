import React, {useState} from 'react'

export default function Accordion(props) {
    const [classes, setClasses]  = useState('overflow-hidden max-h-0')
    const displayed = ()=>{
        if(classes.indexOf('p-4') > -1){
            setClasses('overflow-hidden max-h-0');
        }else{
            setClasses('max-h-96 p-4');
        }
    }
    return (
        <>
            <li className="">
                <div className="duration-300 cursor-pointer py-4 px-5 rounded-lg bg-gray-200 flex justify-between items-center" onClick={()=>{displayed()}}>
                    <span className="select-none">Module {props.number}: {props.title}</span>
                    <i className="icofont-rounded-down"></i>
                </div>
                <div  className={`duration-300 transition-all ${classes} ease-in-out flex justify-between items-start gap-4 font-light`}>
                    <div className="w-10/12">
                        {props.children}
                    </div>
                    <div className="2/12">
                        {props.duration} min <i className="icofont-clock-time text-xl text-etudes-blue"></i>
                    </div>
                </div>
            </li>
        </>
    )
}
