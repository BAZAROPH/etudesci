import React from 'react'

export default function Modal(props) {
  return (
    <div className={`fixed inset-0 h-screen bg-black/[.3] overflow-y-auto md:w-1/2 ${props.open ? '' : 'hidden'}`}>
        <div className='h-72 relative bg-white w-2/3 mx-auto my-auto top-40 rounded-xl p-4 shadow-lg shadow-black'>
            <div className='h-10 border-2 rounded-xl border-etudes-blue shadow flex justify-between items-center px-2'>
                <div className='uppercase font-semibold text-etudes-blue'>{props.title}</div>
                <button className='p-1 px-2 text-white bg-red-500 text-sm rounded-lg hover:bg-red-600 duration-300 hover:scale-125' onClick={()=>props.closeModal()}>
                    <i className="icofont-ui-close"></i>
                </button>
            </div>
            <div className='h-2/3 border-b mb-4'>
                {props.children}
            </div>
            <div className='flex justify-end items-center gap-2 font-semibold'>
                <button className='px-2 py-1 rounded bg-red-500 text-white duration-300 hover:bg-red-600' onClick={()=>props.closeModal()}>Annuler</button>
                <button className='px-2 py-1 rounded bg-etudes-blue text-white duration-300 hover:bg-green-600' onClick={()=>props.del()}>Continuer</button>
            </div>
        </div>
    </div>
  )
}
