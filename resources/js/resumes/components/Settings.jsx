import React, {useState, useEffect} from 'react'
import { ChromePicker, SketchPicker } from 'react-color';
import Color from '../images/icons/Color.png'
import { useNavigate } from 'react-router-dom';

import one from '../images/one.jpg'
import two from '../images/two.jpg'
import three from '../images/three.jpg'
import four from '../images/four.jpg'
import five from '../images/five.jpg'
import six from '../images/six.jpg'
import seven from '../images/seven.jpg'
import height from '../images/height.jpg'
import nine from '../images/nine.jpg'
import ten from '../images/ten.jpg'

export default function Settings(props) {
    const [displayFont, setDisplayFont] = useState(false);
    const [displayColorBox, setDisplayColorBox] = useState(false);
    const [displayShare, setDisplayShare] = useState(false);
    const [displayModels, setDisplayModels] = useState(false);
    const [copied, setCopied] = useState(false);
    const navigate = useNavigate('');


    const [images, setImages] = useState(
        [
            {
                element: one,
                state: 'free',
            },
            {
                element: two,
                state: 'free',
            },
            {
                element: three,
                state: 'premium',
            },
            {
                element: four,
                state: 'free',
            },
            {
                element: five,
                state: 'free',
            },
            {
                element: six,
                state: 'free',
            },
            {
                element: seven,
                state: 'premium',
            },
            {
                element: height,
                state: 'free',
            },
            {
                element: nine,
                state: 'free',
            },
            {
                element: ten,
                state: 'premium',
            }
        ]
    )


    const saveFont = (font)=>{
        let middle = props.data;
        middle.font = font;
        props.setData(middle);
        props.setFont(font);
        setDisplayFont(false);
        props.setRefresh(props.refresh + 1);
    }

    const saveColor = (colorCode)=>{
        let middle = props.data;
        middle.color = colorCode;
        props.setData(middle);
        props.setColor(colorCode)
        props.setRefresh(props.refresh + 1);
    }

    const copy = (link)=>{
        navigator.clipboard.writeText(link);
        setCopied(true);
        setTimeout(()=>{
            setCopied(false);
        }, 3000);

        setTimeout(()=>{
            setDisplayShare(false);
        }, 5000);
    }

    const changeModel = (index)=>{
        let middle = props.data;
        middle.model = index+1;
        props.setData(middle);
        props.setRefresh(props.refresh + 1);
        navigate(`/moncv/${index+1}`)
        setDisplayColorBox(false);
        setDisplayFont(false);
        setDisplayShare(false);
    }

    return (
        <div className='mb-4 w-full sticky top-24 z-40 relative'>
            <div className='p-2 bg-white rounded-lg flex items-center justify-between shadow shadow-2xl'>
                <div className='flex justify-between gap-2 items-center'>
                    <div className='border rounded border-gray-400 hover:text-etudes-blue hover:border-etudes-blue duration-300 cursor-pointer' onClick={()=>{setDisplayModels(!displayModels); setDisplayColorBox(false); setDisplayFont(false); setDisplayShare(false)}}>
                        <i className="icofont-attachment text-3xl"></i>
                    </div>

                    <div className='hover:text-etudes-blue duration-300 cursor-pointer p-1 px-2'>
                        <div className='' onClick={()=>{setDisplayColorBox(!displayColorBox); setDisplayModels(false); setDisplayFont(false); setDisplayShare(false);}}>
                            <img src={Color} className="h-7"/>
                        </div>
                        {
                            displayColorBox && (
                                <div className='absolute mt-2' id='color-box'>
                                    <SketchPicker color={props.color} onChange={(newColor) => saveColor(newColor.hex)}/>
                                </div>
                            )
                        }
                    </div>
                </div>

                <div className='flex items-center justify-center gap-2 relative'>
                    <div className='relative capitalize border p-1 px-2 rounded border-gray-400 hover:text-etudes-blue hover:border-etudes-blue cursor-pointer duration-300' onClick={()=>{setDisplayFont(!displayFont); setDisplayColorBox(false); setDisplayModels(false); setDisplayShare(false)}}>
                        <span>Aa</span>
                    </div>
                    <div>
                        <button className='px-3 py-1 rounded border text-etudes-blue border-etudes-blue bg-etudes-blue/[.1] hover:text-white hover:bg-etudes-blue duration-300' onClick={()=>{props.handleDownload()}}>Télécharger <i className="icofont-download"></i></button>
                    </div>
                    <div>
                        <button className='px-3 py-1 rounded border text-etudes-orange border-etudes-orange bg-etudes-orange/[.1] hover:text-white hover:bg-etudes-orange duration-300' onClick={()=>{setDisplayShare(!displayShare); setDisplayColorBox(false); setDisplayFont(false); setDisplayModels(false)}}>Partager <i className="icofont-share-alt"></i></button>
                    </div>
                </div>
            </div>
            {
                displayFont && (
                    <div className='bg-white  absolute right-44 mt-1 rounded shadow shadow-xl h-56 overflow-auto'>
                        <ul className='divide-y border rounded'>
                            <li onClick={()=>{saveFont('Open Sans')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Open Sans' && 'bg-etudes-blue text-white'}`}>Open Sans</li>
                            <li onClick={()=>{saveFont('Montserrat')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Montserrat' && 'bg-etudes-blue text-white'}`}>Montserrat</li>
                            <li onClick={()=>{saveFont('Poppins')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Poppins' && 'bg-etudes-blue text-white'}`}>Poppins</li>
                            <li onClick={()=>{saveFont('Oswald')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Oswald' && 'bg-etudes-blue text-white'}`}>Oswald</li>
                            <li onClick={()=>{saveFont('Ubuntu')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Ubuntu' && 'bg-etudes-blue text-white'}`}>Ubuntu</li>
                            <li onClick={()=>{saveFont('nu-century-gothic')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'nu-century-gothic' && 'bg-etudes-blue text-white'}`}>Century Gothic</li>
                            <li onClick={()=>{saveFont('Roboto Mono')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Roboto Mono' && 'bg-etudes-blue text-white'}`}>Roboto</li>
                            <li onClick={()=>{saveFont('Rubik')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Rubik' && 'bg-etudes-blue text-white'}`}>Rubik</li>
                            <li onClick={()=>{saveFont('Lobster')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Lobster' && 'bg-etudes-blue text-white'}`}>Lobster</li>
                            <li onClick={()=>{saveFont('Fredoka One')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Fredoka One' && 'bg-etudes-blue text-white'}`}>Fredoka One</li>
                            <li onClick={()=>{saveFont('Lilita One')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'Lilita One' && 'bg-etudes-blue text-white'}`}>Lilita One</li>
                            <li onClick={()=>{saveFont('EB Garamond')}} className={`py-2 px-4 font-semibold hover:text-etudes-white hover:bg-etudes-blue hover:text-white duration-300 cursor-pointer rounded ${props.font === 'EB Garamond' && 'bg-etudes-blue text-white'}`}>EB Garamond</li>
                        </ul>
                    </div>
                )
            }

            {
                displayShare && (
                    <div className='absolute bg-white p-4 rounded mt-2 right-0 divide-y'>
                        <div className='mb-2 text-sm font-semibold ubuntu text-etudes-blue'>
                            Envoyez le lien ci-dessous, aux personnes avec qui vous souhaitez partager votre
                        </div>
                        <div className='flex justify-between items-center gap-4 pt-2'>
                            <span className='text-xs'>{ROOT_URL+'/mon-cv-en-ligne/'+USER_EMAIL}</span>
                            <button className={`text-sm rounded px-2 py-1 text-white ${copied ? 'bg-etudes-orange' : 'bg-etudes-blue'}`} onClick={()=>{copy(ROOT_URL+'/mon-cv-en-ligne/'+USER_EMAIL)}}>Copier <i class={copied ? 'icofont-check-circled' : 'icofont-ui-copy'}></i></button>
                        </div>
                    </div>
                )
            }
            {
                displayModels && (
                    <div className='absolute bg-white rounded-lg p-2 flex w-full overflow-x-auto flex items-center gap-6 mt-2 border border-etudes-blue scroll-hidden animate__animated animate__fadeInDown'>
                        {images.map((image, index)=>{
                            return(
                                <div className='flex-shrink-0'>
                                    <img src={image.element} className='h-20 cursor-pointer' alt="" onClick={()=>changeModel(index)}/>
                                </div>
                            )
                        })}
                    </div>
                )
            }
        </div>
    )
}
