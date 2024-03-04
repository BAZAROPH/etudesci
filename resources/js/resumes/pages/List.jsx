import React, {useState} from 'react'
import { useNavigate } from 'react-router-dom'

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

export default function List() {
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
    return (
        <div>
            <div class="h-56 bg-etudes-blue">
                <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
                    <div class="text-left w-full">
                        <div class="font-semibold tex-2xl md:text-4xl line-clamp-2">Je conçois mon cv avec Etudes.ci </div>
                        <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                            <div>
                                <a href="{{route('home')}}">
                                    Accueil
                                </a>
                            </div>
                            <span>-</span>
                            <div class="font-bold line-clamp-1">
                                Mon CV en ligne
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className='text-center my-6 text-2xl font-semibold text-etudes-blue'>
                <h3>Liste des models disponibles</h3>
            </div>
            <div className='my-4 flex flex-wrap gap-10 justify-center'>
                {
                    images.map((image, index)=>{
                        return (
                            <div className='relative cursor-pointer hover:scale-105 duration-300' onClick={()=>navigate(`/moncv/${index+1}`)}>
                                {image.state === 'premium' &&
                                        <div className='absolute text-2xl md:text-4xl bottom text-[#ffD700] p-2 md:p-4'>
                                            <i className="icofont-diamond "></i>
                                        </div>
                                }
                                <img className={`h-44 md:h-80 rounded-lg border-2 ${image.state === 'free' ? '' : 'border-etudes-orange shadow-etudes-orange shadow-lg'}`} src={image.element} key={index} alt="" />
                            </div>
                        )
                    })
                }
            </div>
        </div>
    )
}
