import React, {useState} from 'react'

export default function SaveButton(props) {
    const [load, setLoad] = useState(false);
    const loading = ()=>{
        setLoad(true);
        props.save()
        setLoad(false);
    }
    return (
        <div className='text-right'>
            <button className='py-2 px-4 bg-etudes-blue/[.8] hover:bg-etudes-blue text-white rounded text-lg duration-300' onClick={()=>{loading()}}>
                <div className="flex items-center gap-2">
                    <span>Enregistrer</span>
                    {load ?
                        <div className='border-2 rounded-full h-4 w-4 animate-spin border-whitz border-t-transparent'></div>
                        :
                        <i className="icofont-check-circled"></i>
                    }
                    </div>
            </button>
        </div>
    )
}
