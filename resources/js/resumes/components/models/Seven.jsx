import React from 'react'
import text from '../../images/text.png'
import { PDFExport } from "@progress/kendo-react-pdf";
import '../fonts/fonts.css'
import linkedinBlack from '../../images/icons/linkedinBlack.png'
import skypeBlack from '../../images/icons/skypeBlack.png'
import twitterBlack from '../../images/icons/twitterBlack.png'

export default function Seven(props) {
    return (
        <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
            <div className={`relative max-h-[2480px] grid grid-cols-6 relative`} style={{'fontFamily': props.font}}>
                <img src={props.data.personal.image} className='h-48 absolute right-2 rounded-full top-2' alt="" />
                <div className='p-5 bg-green-900 w-full col-span-6'>
                    <div className='uppercase text-white text-3xl pl-5 font-semibold'>{props.data.personal.first_name} {props.data.personal.last_name}</div>
                    <div className='uppercase text-white text-xl pl-5'>{props.data.personal.title}</div>
                </div>
                <div className='bg-green-700 p-4 col-span-6'>
                    <div className='w-2/3 flex justify-between items-center text-white text-sm'>
                        <span>{props.data.personal.address}</span>
                        <span>{props.data.personal.phone}</span>
                        <span>{props.data.personal.email}</span>
                    </div>
                </div>
                <div className='bg-white col-span-4 px-4 py-6'>
                    <div>
                        <div className='uppercase text-lg font-semibold mb-3'>Formations</div>
                        {
                            props.data.diploma.map((diploma, index)=>{
                                return (
                                    <div key={index} className='flex items-start w-2/3'>
                                        <div className='w-1/3 text-xs text-gray-400'>
                                            <div>{diploma.end_year},</div>
                                            <div className='capitalize'>{diploma.city}</div>
                                        </div>
                                        <div className='w-2/3'>
                                            <div className="uppercase text-sm text-green-700 font-semibold">{diploma.formation}</div>
                                            <div className="capitalize">{diploma.school}</div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>

                    <div className='mt-4'>
                        <div className='uppercase text-lg font-semibold mb-3'>EXPERIENCES PROFESSIONNELLES</div>
                        {
                            props.data.xp.map((xp, index)=>{
                                return (
                                    <div key={index} className='flex items-start w-3/4'>
                                        <div className='w-1/3 text-xs text-gray-400'>
                                            <div>{xp.begin_month}/{xp.begin_year} -</div>
                                            <div>{xp.end_month}/ {xp.end_year}</div>
                                            <div>({xp.city})</div>
                                        </div>
                                        <div className='w-full'>
                                            <div className="capitalize"><span className='uppercase'>{xp.post}</span></div>
                                            <div className="uppercase text-sm text-green-700 font-semibold">{xp.company}</div>
                                            <div className="text-sm">
                                                {xp.description}
                                            </div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>
                    <div className='mt-4'>
                        <div className='uppercase text-lg font-semibold mb-3'>Compétences</div>
                        <div className='grid grid-cols-2 gap-6'>
                            {
                                props.data.skill.map((skill, index)=>{
                                    return (
                                        <div key={index} className='flex items-center text-sm'>
                                            <span className='w-1/3'>{skill.skill}</span>
                                            <div className='w-full h-2 bg-green-900'>
                                                <div className="h-2 bg-green-700" style={{'width': (language.level*20)+'%'}}></div>
                                            </div>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>
                </div>
                <div className='bg-gray-300 col-span-2 px-4 pt-12 h-full'>
                    <div>
                        <div className="uppercase text-lg font-semibold">Profil</div>
                        <div className='text-xs'>
                            {props.data.personal.title}
                        </div>
                    </div>
                    <div className='mt-4'>
                        <div className="uppercase text-lg font-semibold">Langues</div>
                        {
                            props.data.language.map((language, index)=>{
                                return (
                                    <div key={index} className='flex items-center gap-2 text-sm'>
                                        <div className='w-1/3 capitalize'>
                                            {language.language}
                                        </div>
                                        <div className='w-full h-2 bg-green-900'>
                                            <div className="h-2 bg-green-700" style={{'width': (language.level*20)+'%'}}></div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>
                    <div className='mt-4'>
                        <div className="uppercase text-lg font-semibold">Réseaux sociaux</div>
                        {
                            props.data.personal.skype &&
                            <div className='flex gap-4 items-center'>
                                <img src={skypeBlack} className='h-5' alt="" />
                                <span className='text-sm'>{props.data.personal.skype}</span>
                            </div>
                        }
                        {
                            props.data.personal.linkedin &&
                            <div className='flex gap-4 items-center'>
                                <img src={linkedinBlack} className='h-5' alt="" />
                                <span className='text-sm'>{props.data.personal.linkedin}</span>
                            </div>
                        }
                        {
                            props.data.personal.twitter &&
                            <div className='flex gap-4 items-center'>
                                <img src={twitterBlack} className='h-5' alt="" />
                                <span className='text-sm'>{props.data.personal.twitter}</span>
                            </div>
                        }
                    </div>
                </div>
                <div className='col-span-6 p-4 bg-green-700'>
                    <div className='text-white uppercase text-sm font-semibold'>
                        CENTRES D'INTÉRÊT
                    </div>
                    <div className='flex justify-left mt-2 items-center divide-x'>
                        {
                            props.data.interest.map((interest, index)=>{
                                return (
                                    <span key={index} className='capitalize px-2 text-white'>{interest}</span> )
                                })
                        }
                    </div>
                </div>
            </div>
        </PDFExport>
    )
}
