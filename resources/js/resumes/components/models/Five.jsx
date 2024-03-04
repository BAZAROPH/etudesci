import React from 'react'
import essai from '../../images/essai.jpg'
import emailBlack from '../../images/icons/emailBlack.png'
import phoneCallGray from '../../images/icons/phoneCallGray.png'
import homeGray from '../../images/icons/homeGray.png'
import { PDFExport } from "@progress/kendo-react-pdf";
import '../fonts/fonts.css'

export default function Five(props) {
    return (
        <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
            <div className={`relative max-h-[2480px] grid grid-cols-5`} style={{'fontFamily': props.font}}>
                <div className={`col-span-2 text-white px-3 py-4 text-white`} style={{'backgroundColor': props.color}}>
                    <div className=''>
                        <img src={props.data.personal.image} className='h-56 mx-auto rounded-full ring-4 ring-white' alt="" />
                    </div>
                    <div className='mt-4 space-y-4'>
                        <div className='mr-14'>
                            <div className='text-lg uppercase font-semibold border-b'>Profil</div>
                            <div className='mt-2 text-sm'>
                                {props.data.personal.description}
                            </div>
                        </div>
                        <div className='mr-14'>
                            <div className='text-lg uppercase font-semibold border-b'>Formation</div>
                            <div className='mt-2 text-xs'>
                                {
                                    props.data.diploma.map((diploma, index)=>{
                                        return (
                                            <ul key={index}>
                                                <li>{diploma.begin_year}-{diploma.end_year}</li>
                                                <li className='uppercase'>{diploma.formation}</li>
                                                <li>{diploma.school}</li>
                                            </ul>
                                        )
                                    })
                                }
                            </div>
                        </div>
                        <div className='mr-14'>
                            <div className='text-lg uppercase font-semibold border-b'>Langues</div>
                            <div className='mt-2 text-sm space-y-4'>
                                {
                                    props.data.language.map((language, index)=>{
                                        return (
                                            <div key={index} className='flex justify-between items-center'>
                                                <span className='font-semibold w-1/3'>{language.language}</span>
                                                <div className='w-2/3 h-2 bg-gray-700 rounded'>
                                                    <div className='h-2 bg-white rounded' style={{'width': (language.level*20)+'%'}}>
                                                    </div>
                                                </div>
                                            </div>
                                            )
                                        })
                                }
                            </div>
                        </div>
                        <div className='grid grid-cols-3 gap-8 max-auto'>
                            {
                                props.data.skill.map((skill, index)=>{
                                    return (
                                            <div key={index} className='h-28 border-4 border-white rounded-full flex flex-col justify-center items-center'>
                                                <div className='font-semibold capitalize'>{skill.skill}</div>
                                            </div>
                                        )
                                })
                            }
                        </div>
                        <div className='mr-14'>
                            <div className='text-lg uppercase font-semibold border-b'>Centres d'intérêt</div>
                            <div className='mt-2 text-sm'>
                                {
                                    props.data.interest.map((interest, index)=>{
                                    return (
                                            <div key={index}>{interest}</div>
                                        )
                                    })
                                }
                            </div>
                        </div>
                    </div>
                </div>
                <div className='col-span-3 bg-white h-full'>
                    <div className='p-10'>
                        <div className='text-gray-800 text-3xl font-semibold'>{props.data.personal.first_name} {props.data.personal.last_name}</div>
                        <div className='text-gray-400 font-semibold text-lg uppercase'>{props.data.personal.title}</div>
                    </div>
                    <div>
                        <div className='pl-10 bg-gray-400 py-1 text-xl uppercase w-4/6 rounded-r-full text-white font-medium'>
                            Contact
                        </div>
                        <div className='my-4 pl-10 space-y-2'>
                            <div className='flex gap-4 items-center'>
                                <img src={phoneCallGray} className='h-4' alt="" />
                                <span>{props.data.personal.phone}</span>
                            </div>
                            <div className='flex gap-4 items-center'>
                                <img src={emailBlack} className='h-4' alt="" />
                                <span>{props.data.personal.email}</span>
                            </div>
                            <div className='flex gap-4 items-center'>
                                <img src={homeGray} className='h-4' alt="" />
                                <span>{props.data.personal.address}</span>
                            </div>
                        </div>
                    </div>
                    <div className='mt-10 text-gray-700'>
                        <div className='pl-10 bg-gray-400 py-1 text-xl uppercase w-4/6 rounded-r-full text-white font-medium'>
                            EXPÉRIENCE PROFESSIONNELLE
                        </div>
                        <div className='my-4 pl-10 space-y-2'>
                            {
                                props.data.xp.map((xp, index)=>{
                                    return (
                                        <div key={index} className='max-w-sm'>
                                            <div className='border-b-2 border-gray-300 pb-1'>
                                                <span className='text-lg font-semibold'>{xp.begin_year}-{xp.end_year} <span className="uppercase">{xp.post}</span></span>
                                                <div>
                                                    {xp.company} - {xp.city}
                                                </div>
                                            </div>
                                            <div className='text-sm pt-2'>
                                                {xp.description}
                                            </div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>
                </div>
            </div>
        </PDFExport>
    )
}
