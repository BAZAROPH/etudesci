import React from 'react'

export default function MoveButton(props) {
    const move = (direction)=>{
        if(direction === '+' && props.step < props.levels.length-1){
            props.setStep(props.step+1);
        }else if(direction === '-' && props.step > 0){
            props.setStep(props.step-1);
        }
    }
    return (
        <div className='text-xl z-40 font-semibold text-etudes-blue flex items-center justify-between bg-white sticky top-20 p-4 rounded-lg'>
            <span>{props.step+1} - {props.title}</span>

            <div className='flex gap-4 items-center'>
                {props.step > 0 &&
                    <button className={`px-2 py-1 text-sm rounded durantion-300 ${props.step > 0 ? 'bg-gray-200 hover:bg-etudes-blue hover:text-white' : 'bg-etudes-blue text-white'}`} onClick={()=>{move('-')}}>
                        Précédent
                    </button>
                }
                {props.step < props.levels.length-1 &&
                    <button className={`px-4 py-1 text-sm rounded durantion-300  ${props.step < props.levels.length-1 ? 'bg-gray-200 hover:bg-etudes-blue hover:text-white' : 'bg-etudes-blue text-white'}`} onClick={()=>{move('+')}}>
                        Suivant
                    </button>
                }
            </div>
        </div>

    )
}
