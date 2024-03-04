import React from 'react'
import essai from '../../images/essai.jpg'
import linkedinWhite from '../../images/icons/linkedinWhite.png'
import skypeWhite from '../../images/icons/skypeWhite.png'
import twitterWhite from '../../images/icons/twitterWhite.png'
import pinLocationBlack from '../../images/icons/pinLocationBlack.png'
import emailBlack from '../../images/icons/emailBlack.png'
import phoneCallBlack from '../../images/icons/phoneCallBlack.png'
import { PDFExport } from "@progress/kendo-react-pdf";

export default function Three(props) {
  return (
    <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
        <div className='grid grid-cols-2 relative' style={{'fontFamily': props.font}}>
            <div className='p-4 text-xl text-white' style={{'backgroundColor': props.color}}>
                <div className='mt-10'>
                    <div className='capitalize font-semibold'>{props.data.personal.first_name}</div>
                    <div className='uppercase font-bold'>{props.data.personal.last_name}</div>
                    <div className='mt-2 text-sm uppercase font-bold text-rose-300'>
                        {props.data.personal.title}
                    </div>
                </div>

                <div className='mt-10 space-y-4'>
                    {
                        props.data.personal.skype &&
                        <div className='flex gap-4 items-center'>
                            <img src={skypeWhite} className='h-5' alt="" />
                            <span className='text-sm'>{props.data.personal.skype}</span>
                        </div>
                    }
                    {
                        props.data.personal.linkedin &&
                        <div className='flex gap-4 items-center'>
                            <img src={linkedinWhite} className='h-5' alt="" />
                            <span className='text-sm'>{props.data.personal.linkedin}</span>
                        </div>
                    }
                    {
                        props.data.personal.twitter &&
                        <div className='flex gap-4 items-center'>
                            <img src={twitterWhite} className='h-5' alt="" />
                            <span className='text-sm'>{props.data.personal.twitter}</span>
                        </div>
                    }
                </div>

                <div className='my-10'>
                    <div className=' text-sm uppercase font-bold text-rose-300'>
                        EXPÉRIENCES PROFESSIONNELLES
                    </div>
                    <div className='mt-2 space-y-4'>
                        {
                            props.data.xp.map((xp, index)=>{
                                return (
                                    <div key={index} className="grid grid-cols-3 gap-2">
                                        <div className='text-sm'>
                                            <div>Du {xp.begin_month}/ {xp.begin_year}</div>
                                            <div>Au {xp.end_month}/ {xp.end_year}</div>
                                            <div>(xp.city)</div>
                                        </div>
                                        <div className='col-span-2 text-sm'>
                                            <div className='uppercase font-medium'>{xp.company}</div>
                                            <div className=''>{xp.post}</div>
                                            <div className='text-xs'>Tâches réalisée</div>
                                            <div>
                                                <p className='text-xs'>
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
            <div className='absolute left-0 right-0 m-auto w-32'>
                <img src={props.data.personal.image} className='h-32 rounded-full border-4 border-white' alt="" />
            </div>
            <div className='p-5 bg-white'>
                <div className='ml-14 mt-4 space-y-2'>
                    <div className='flex gap-4 items-center'>
                        <img src={pinLocationBlack} className='h-4' alt="" />
                        <span className='text-sm'>{props.data.personal.address}</span>
                    </div>
                    <div className='flex gap-4 items-center'>
                        <img src={phoneCallBlack} className='h-4' alt="" />
                        <span className='text-sm'>{props.data.personal.phone}</span>
                    </div>
                    <div className='flex gap-4 items-center'>
                        <img src={emailBlack} className='h-4' alt="" />
                        <span className='text-sm'>{props.data.personal.email}</span>
                    </div>
                </div>
                <div className='mt-10'>
                    <p className='text-sm leading-5'>
                        {props.data.personal.description}
                    </p>
                </div>
                <div className='mt-10'>
                    <div className=' text-sm uppercase font-bold mb-5'>
                        Formation
                    </div>

                    <div className="space-y-2">
                        {
                            props.data.diploma.map((diploma, index)=>{
                                return (
                                    <div key={index} className='grid grid-cols-3'>
                                        <div className='text-gray-400'>
                                            <div className='text-sm'>{diploma.end_year}</div>
                                            <div className='text-sm'>{diploma.city}</div>
                                        </div>
                                        <div className="col-span-2">
                                            <div>{diploma.formation}</div>
                                            <div className='text-xs italic font-medium'>
                                                {diploma.school}
                                            </div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>
                </div>
                <div className='mt-10'>
                    <div className=' text-sm uppercase font-bold mb-5'>
                    LANGUES
                    </div>

                    <div className="space-y-2">
                        {
                            props.data.language.map((language, index)=>{
                                return (
                                    <div key={index} className='grid grid-cols-3 items-center'>
                                        <div className='text-gray-400'>
                                            <div className='text-sm'>{language.language}</div>
                                        </div>
                                        <div className="col-span-2">
                                            <div className='h-2 w-full bg-gray-200 rounded-xl'>
                                                <div className='h-2 bg-rose-300 rounded-xl' style={{'width': (language.level*20)+'%'}}></div>
                                            </div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>
                </div>
                <div className='mt-10'>
                    <div className=' text-sm uppercase font-bold mb-5'>
                    Compétences
                    </div>

                    <div className="space-y-2">
                        <ul className='text-sm list-style list-disc ml-4'>
                            {
                                props.data.skill.map((skill, index)=>{
                                    return (
                                        <li key={index}>{skill.skill}</li>
                                    )
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
