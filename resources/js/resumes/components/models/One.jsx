import React from 'react'
import emailBlack from '../../images/icons/emailBlack.png'
import phoneCallBlack from '../../images/icons/phoneCallBlack.png'
import pinLocationBlack from '../../images/icons/pinLocationBlack.png'
import checkMarkBlack from '../../images/icons/checkMarkBlack.png'
import { PDFExport } from "@progress/kendo-react-pdf";
import '../fonts/fonts.css'

export default function One(props) {
    const numbers = [0, 1 ,2 ,3, 4];
    // console.log(props.data.personal.image)
  return (
    <PDFExport ref={props.pdfRef} landscape={false} paperSize='A4'>
        <div className={`relative max-h-[2480px]`} style={{'fontFamily': props.font}}>
            <div className={`px-5 py-3`} style={{'backgroundColor': `${props.color}`}}>
                <div className=''>
                    <img src={props.data.personal.image} className='h-32 mx-auto' alt="" />
                </div>
                <div className="text-center text-white text-2xl font-bold capitalize mt-2">
                    {props.data.personal.first_name} {props.data.personal.last_name}
                </div>
                <div className={`text-center text-lg text-white font-bold`}>
                    {props.data.personal.title}
                </div>
            </div>
            <div className='p-5 bg-white'>
                <div className="grid grid-cols-5 gap-4">
                    <div className="col-span-2">

                        <div>
                            <div className={`uppercase font-bold text-xl`} style={{'color': `${props.color}`}}>Profil</div>
                            <div className='mt-2'>
                                <p className='text-sm'>
                                    {props.data.personal.description}
                                </p>
                            </div>
                        </div>

                        <div className='mt-10 text-sm space-y-1'>
                            <div className='flex gap-4 items-center'>
                                <img src={emailBlack} className='h-4' alt="" />
                                <span>{props.data.personal.email}</span>
                            </div>
                            <div className='flex gap-4 items-center'>
                                <img src={phoneCallBlack} className='h-4' alt="" />
                                <span>{props.data.personal.phone}</span>
                            </div>
                            <div className='flex gap-4 items-center'>
                                <img src={pinLocationBlack} className='h-4' alt="" />
                                <span>{props.data.personal.address}</span>
                            </div>
                        </div>

                        <div className='mt-10'>
                            <div className={`uppercase font-bold text-xl`} style={{'color': `${props.color}`}}>Compétences</div>
                            {props.data.skill && props.data.skill.map((skill, index)=>{
                                return (
                                    <div className='flex gap-4 items-center justify-between mt-2'>
                                        <div>
                                            <span>{skill.skill}</span>
                                        </div>
                                        <div>
                                            <ul className='flex gap-2'>
                                                {
                                                    numbers.map((value, index)=>{
                                                        return (
                                                            <li key={index} className={`w-3 h-3 rounded-full ${skill.level > index ? 'bg-[props.color]' : 'bg-gray-200'}`} style={{'backgroundColor': `${skill.level > index ? props.color : 'rgb(209 213 219)'}`}}></li>
                                                        )
                                                    })
                                                }
                                            </ul>
                                        </div>
                                    </div>
                                )
                            })}
                        </div>

                        <div className='mt-10 text-sm space-y-1'>
                            <div className={`uppercase font-bold text-xl`} style={{'color': `${props.color}`}}>langues</div>
                            {
                                props.data.language && props.data.language.map((language, index)=>{
                                    return (
                                        <div key={index} className='flex gap-4 items-center'>
                                            <img src={checkMarkBlack} className='h-4' alt="" />
                                            <span>{language.language}</span>
                                        </div>
                                    )
                                })
                            }
                        </div>

                    </div>
                    <div className="col-span-3">
                        <div>
                            <div className={`uppercase font-bold text-xl`} style={{'color': `${props.color}`}}>EXPERIENCE PROFESSIONNELLE</div>
                            {
                                props.data.xp && props.data.xp.map((xp, index)=>{
                                    return (
                                        <div key={index} className='mt-2 grid grid-cols-6 items-start'>
                                            <div className='text-sm col-span-2 text-gray-400'>
                                                <div>
                                                    Du {xp.begin_month}/ {xp.begin_year}
                                                </div>
                                                <div>
                                                    Au {xp.end_month}/ {xp.end_year}

                                                </div>
                                                <div>
                                                    ({xp.city})
                                                </div>
                                            </div>
                                            <div className="col-span-4 ">
                                                <div className='text-base font-medium uppercase'>{xp.company}</div>
                                                <div className='text-base font-light text-gray-400'>{xp.city}</div>
                                                <div className='text-base font-light'>Tâches réalisées:</div>
                                                <div>
                                                    <p className='text-sm text-justify leading-4'>
                                                        {xp.description}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    )
                                })
                            }
                        </div>

                        <div className='mt-10'>
                            <div className={`uppercase font-bold text-xl`} style={{'color': `${props.color}`}}>FORMATION</div>
                            {
                                props.data.diploma && props.data.diploma.map((diploma, index)=>{
                                    return (
                                        <div className='mt-2 grid grid-cols-6 items-start'>
                                            <div className='text-sm col-span-2 text-gray-400'>
                                                <div>
                                                    {diploma.end_year}
                                                </div>
                                                <div>
                                                    {diploma.city}
                                                </div>
                                            </div>
                                            <div className="col-span-4 ">
                                                <div className='text-base font-medium'>{diploma.formation}</div>
                                                <div className='text-sm font-light text-gray-400'>{diploma.school}</div>
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
