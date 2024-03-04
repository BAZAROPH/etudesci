import React from 'react'
import essai from '../../images/essai.jpg'
import emailWhite from '../../images/icons/emailWhite.png'
import phoneCallWhite from '../../images/icons/phoneCallWhite.png'
import pinLocationWhite from '../../images/icons/pinLocationWhite.png'
import { PDFExport } from "@progress/kendo-react-pdf";

export default function Four(props) {
    const levelLabel = [
        'Choisissez',
        'Débutant(e)',
        'Intermédiraire',
        'Bien',
        'Très bien',
        'Excellent',
    ]
    return (
        <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
            <div className='relative'>
                <div className='h-36' style={{'backgroundColor': props.color}}>
                    <div className='grid grid-cols-2 mx-10 h-full'>
                        <div className='flex flex-col justify-center items-start text-white'>
                            <div>
                                <div className='font-semibold text-xl'>{props.data.personal.first_name}</div>
                                <div className='text-xl font-semibold'>{props.data.personal.last_name}</div>
                            </div>
                        </div>
                        <div className='absolute right-0 left-0 w-36 m-auto mt-6 z-30'>
                            <img src={props.data.personal.image} className='' alt="" />
                        </div>
                        <div className='flex flex-col justify-center items-end text-white'>
                            <div>
                                <div className='font-semibold text-lg'>{props.data.personal.title}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='grid grid-cols-9 bg-white px-10 py-10'>
                    <div className='col-span-4 mt-5  border-r-2 border-gray-300'>
                        <div>
                            <div className='uppercase font-semibold text-base' style={{'color': props.color}}>Compétences</div>
                            <ul className='list-disc ml-3 text-sm mt-2 space-y-1'>
                                {
                                    props.data.skill.map((skill, index)=>{
                                        return (
                                            <li key={index}>{skill.skill}</li>
                                        )
                                    })
                                }
                            </ul>
                        </div>
                        <div className='mt-5'>
                            <div className='uppercase font-semibold text-base' style={{'color': props.color}}>Formation</div>
                            <div className='space-y-2 mt-2'>
                                {
                                    props.data.diploma.map((diploma, index)=>{
                                        return (
                                            <div key={index}>
                                                <div className='text-xs'>{diploma.end_year}</div>
                                                <div className='text-sm font-medium'>{diploma.formation}</div>
                                                <div className='text-sm font-medium italic'>{diploma.school}</div>
                                                <div className='text-xs'>{diploma.city}</div>
                                            </div>
                                        )
                                    })
                                }
                            </div>
                        </div>
                        <div className="mt-5">
                            <div className='uppercase font-semibold text-base' style={{'color': props.color}}>Langues</div>
                            <div className='space-y-1 mt-2'>
                                {
                                    props.data.language.map((language, index)=>{
                                        return (
                                            <div key={index} className="flex gap-2 items-cente text-sm">
                                                <span>{language.language} : </span>
                                                <span>{levelLabel[language.level]}</span>
                                            </div>
                                        )
                                    })
                                }
                            </div>
                        </div>
                    </div>
                    <div className='col-span-5 mt-5 pl-6'>
                        <div>
                            <div className='uppercase font-semibold text-base' style={{'color': props.color}}>Expérience professionnelle</div>
                            <div className='space-y-2 mt-2'>
                                {
                                    props.data.xp.map((xp, index)=>{
                                        return (
                                            <div key={index} className="grid grid-cols-3">
                                                <div className='text-xs text-gray-500'>
                                                    <div>Du {xp.begin_month}/{xp.begin_year}</div>
                                                    <div>Au {xp.end_month}/{xp.end_year}</div>
                                                    <div>({xp.city})</div>
                                                </div>
                                                <div className="col-span-2">
                                                    <div className='text-sm font-medium'>{xp.company}</div>
                                                    <div className='text-sm text-gray-500'>{xp.post}</div>
                                                    <div className="text-xs">Tâches réalisées:</div>
                                                    <div>
                                                        <p className='text-xs text-justify'>
                                                            {xp.description}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        )
                                    })
                                }
                            </div>
                        </div>
                    </div>
                </div>
                <div className='p-6' style={{'backgroundColor': props.color}}>
                    <div className="text-white flex justify-between items-center mx-16">
                        <div className='text-center text-sm font-thin'>
                            <img src={phoneCallWhite} className='h-4 mx-auto mb-1' alt="" />
                            <div>{props.data.personal.phone}</div>
                        </div>
                        <div className='text-center text-sm font-thin'>
                            <img src={emailWhite} className='h-4 mx-auto mb-1' alt="" />
                            <div>{props.data.personal.email}</div>
                        </div>
                        <div className='text-center text-sm font-thin'>
                            <img src={pinLocationWhite} className='h-4 mx-auto mb-1' alt="" />
                            <div>{props.data.personal.address}</div>
                        </div>
                    </div>
                </div>
            </div>
        </PDFExport>
    )
}
