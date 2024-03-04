import React from 'react'
import checkMarkBlack from '../../images/icons/checkMarkBlack.png'
import { PDFExport } from "@progress/kendo-react-pdf";
import '../fonts/fonts.css'

export default function Six(props) {
    return (
        <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
            <div className={`relative max-h-[2480px] grid grid-cols-6`} style={{'fontFamily': props.font}}>
                <div className='col-span-4 border-r-8' style={{'backgroundColor': props.color, 'borderColor': props.color}}>
                    <div className='p-10 max-h-[17em] h-full text-white'>
                        <div className='font-bold text-3xl'>
                            {props.data.personal.first_name} {props.data.personal.last_name}
                        </div>
                        <div className='italic text-xl uppercase'>{props.data.personal.title}</div>
                        <div className='mt-8'>
                            <div className='uppercase text-xl font-semibold'>Profil</div>
                            <div>
                                {props.data.personal.description}
                            </div>
                        </div>
                    </div>
                    <div className='p-10 bg-white'>
                        <div className='text-xl font-semibold uppercase' style={{'color': props.color}}>Expériences professionnelles</div>
                        <div className="mt-3 space-y-6">
                            {
                                props.data.xp.map((xp, index)=>{
                                    return (
                                        <div className='' key={index}>
                                            <div className='uppercase font-semibold'>{xp.post} | <span className='italic font-medium'>{xp.company}</span></div>
                                            <div className='capitalize text-gray-500 pt-1'>{xp.begin_year} - {xp.end_year} | {xp.city}</div>
                                            <ul className='pl-3 pt-1'>
                                                <li>
                                                    {xp.description}
                                                </li>
                                            </ul>
                                        </div>
                                    )
                                })
                            }
                        </div>

                        <div className='text-xl font-semibold uppercase mt-8' style={{'color': props.color}}>FORMATION</div>
                        <div className="mt-3 space-y-6">
                            {
                                props.data.diploma && props.data.diploma.map((diploma, index)=>{
                                    return (
                                        <div className='' key={index}>
                                            <div className='uppercase font-semibold'>{diploma.formation} / <span className='italic font-medium'>{diploma.school}</span></div>
                                            <div className='capitalize text-gray-500 pt-1'>{diploma.begin_month} {diploma.begin_year} - {diploma.end_month} {diploma.end_year}| {diploma.city}</div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>
                </div>
                <div className="col-span-2 bg-white">
                    <img src={props.data.personal.image} alt="" className='w-full max-h-[17em] object-cover' />
                    <div className='px-8 pt-10'>
                        <div>
                            <div className='text-xl font-semibold uppercase' style={{'color': props.color}}>Contact</div>
                            <div className='text-lg mt-4'>
                                <div>{props.data.personal.phone}</div>
                                <div>{props.data.personal.email}</div>
                                <div className='capitalize'>{props.data.personal.address}</div>
                            </div>
                        </div>

                        <div className='mt-6'>
                            <div className='text-xl font-semibold uppercase' style={{'color': props.color}}>Compétences</div>
                            <div className='mt-4'>
                                <ul className='space-y-2'>
                                    {
                                        props.data.skill && props.data.skill.map((skill, index)=>{
                                            return (
                                                <li key={index} className="flex gap-4 items-center">
                                                    <img src={checkMarkBlack} className='h-4' alt="" />
                                                    <span>{skill.skill}</span>
                                                </li>
                                            )
                                    })}
                                </ul>
                            </div>
                        </div>

                        <div className='mt-6'>
                            <div className='text-xl font-semibold uppercase' style={{'color': props.color}}>Langues</div>
                            <ul className='mt-4 space-y-2'>
                                {
                                    props.data.language && props.data.language.map((language, index)=>{
                                        return (
                                            <li key={index} className='capitalize'>{language.language}: {language >= 3 ? 'Bilingue': language >= 2 ? 'Intermédiaire' : 'Débutant'}</li>
                                        )
                                    })
                                }
                            </ul>
                        </div>

                        <div className='mt-6'>
                            <div className='text-xl font-semibold uppercase' style={{'color': props.color}}>Loisirs</div>
                            <ul className='mt-4 space-y-2 list-disc pl-4'>
                                {
                                    props.data.interest.map((interest, index)=>{
                                        return (
                                            <li key={index} className='capitalize'>{interest}</li> )
                                        })
                                }
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </PDFExport>
    )
}
