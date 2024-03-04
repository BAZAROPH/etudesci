import React from 'react'
import essai from '../../images/essai.jpg'
import { PDFExport } from "@progress/kendo-react-pdf";

export default function Two(props) {
  return (
    <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
        <div className='grid grid-cols-4 relative w-full' style={{'fontFamily': props.font}}>
            <div className='absolute h-20 w-full bg-gray-400 mt-10 text-right'>
                <div className='px-6 py-4 mr-4'>
                    <div className='text-white font-bold text-2xl'>{props.data.personal.first_name}</div>
                    <div className='text-xs text-white'>{props.data.personal.title}</div>
                </div>
            </div>
            <div className='p-3' style={{'backgroundColor': props.color}}>
                <div className=''>
                    <img src={props.data.personal.image} alt="" className='h-40 w-32 absolute z-30' />
                </div>
                <div className='w-full text-white mt-44'>
                    <div>
                        <div className='text-base font-medium uppercase'>Profil</div>
                        <div className='text-xs'>
                            {props.data.personal.description}
                        </div>
                    </div>

                    <div className='mt-10'>
                        <div className='text-base font-medium uppercase'>Compétences</div>
                        <div className='text-xs'>
                            <ul className='space-y-1 mt-1'>
                                {
                                    props.data.skill.map((skill, index)=>{
                                        return (
                                            <li key={index} className=''>{skill.skill}</li>
                                        )
                                    })
                                }
                            </ul>
                        </div>
                    </div>

                    <div className='mt-10'>
                        <div className='text-base font-medium'>Langues</div>
                        <div className='text-xs'>
                            <ul className='space-y-1 mt-1'>
                                {
                                    props.data.language.map((language, index)=>{
                                        return (
                                            <li key={index} className=''>{language.language}</li>
                                        )
                                    })
                                }
                            </ul>
                        </div>
                    </div>

                    <div className='mt-10'>
                        <div className='text-base font-medium'>Intérêts</div>
                        <div className='text-xs'>
                            <ul className='space-y-1 mt-1'>
                                {
                                    props.data.interest.map((interest, index)=>{
                                        return (
                                            <li key={index} className=''>{interest}</li>
                                        )
                                    })
                                }
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div className='col-span-3 bg-white px-10'>
                <div className='mt-36'>
                    <div>
                        <div className='uppercase font-medium'>Formations</div>
                        <div className='space-y-2 text-gray-500'>
                            {
                                props.data.diploma.map((diploma, index)=>{
                                    return (
                                        <div key={index} className='grid grid-cols-5 items-center'>
                                            <div>
                                                <div className='text-base text-center'>{diploma.end_year}</div>
                                                <div className='text-xs text-center'>{diploma.city}</div>
                                            </div>
                                            <div className="col-span-4">
                                                <div className=''>
                                                    {diploma.formation}
                                                </div>
                                                <div className='text-sm text-black italic'>{diploma.description}</div>
                                            </div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>

                    <div className='mt-10'>
                        <div className='uppercase font-medium'>EXPERIENCES PROFESSIONNELLES</div>
                        <div className='space-y-2 text-gray-500'>
                            {
                                props.data.xp.map((xp, index)=>{
                                    return (
                                        <div key={index} className='grid grid-cols-5 items-center'>
                                            <div>
                                                <div className='text-base text-center'>{xp.end_year}</div>
                                                <div className='text-xs text-center'>{xp.city}</div>
                                            </div>
                                            <div className="col-span-4">
                                                <div className=''>
                                                    {xp.post}
                                                </div>
                                                <div className='text-sm text-black'>Missions ou tâches réalisées:</div>
                                                <div className='text-xs text-black'>{xp.description}</div>
                                            </div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PDFExport>
  )
}
