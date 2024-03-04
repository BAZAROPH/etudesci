import React, {useState, useEffect} from 'react'
import Accordion from './components/Accordion'
import ModuleAccordion from './components/ModuleAccordion'
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';

export default function Main() {
    const navigate = useNavigate();
    const renderHTML = (rawHTML) => React.createElement("div", { dangerouslySetInnerHTML: { __html: rawHTML } });
    const [tabActive, setTabActive] = useState('description');
    const [refresh, setRefresh] = useState(0);
    const [modulesFinished, setModulesFinished] = useState(null);
    const [course, setCourse] = useState({});
    const [office, setOffice] = useState({});
    const [courseDomaines, setCourseDomaines] = useState([]);
    const [modules, setModules] = useState([]);
    const [currentModule, setCurrentModule] = useState({});
    const [firstModule, setFirstModule] = useState({});
    const [lastModule, setLastModule] = useState({});
    const {slug, module_slug} = useParams();
    const token = localStorage.getItem('token');
    // console.log(ROOT_URL);
    const header = {
        "Content-type": "application/json",
        "Authorization": `Bearer ${token}`,
    }
    useEffect(() => {

        // get course
        const data = {
            'slug': slug,
        }
        axios.post(`${ROOT_URL}/api/get-course`, data, header)
        .then((response)=>{
            if(response.data.course){
                setCourse(response.data.course);
                setCourseDomaines(response.data.courseDomaines);
                setOffice(response.data.office);
                setModules(response.data.modules);
                setFirstModule(response.data.modules[0]);
                setLastModule(response.data.modules[response.data.modules.length-1]);
                let finished = [];
                for (let index = 0; index < response.data.modules.length; index++) {
                    if(response.data.modules[index].users[0].state === 1){
                        finished.push(response.data.modules[index]);
                    }
                }
                setModulesFinished(finished);
            }else{
                console.log("Erreur de récupération");
            }
        })
        .catch((error)=>{
            console.log(error);
        })

        //get module
        const secondData = {
            'slug': module_slug,
        }
        axios.post(`${ROOT_URL}/api/get-module`, secondData, header)
        .then((response)=>{
            if(response.data.module){
                setCurrentModule(response.data.module);
                if (modulesFinished) {
                    if(modulesFinished.length>0 && refresh === 0){
                        setCurrentModule(modulesFinished[modulesFinished.length-1]);
                    }
                }
            }else{
                console.log("Erreur de récupération");
            }
        })
        .catch((error)=>{
            console.log(error);
        })
    }, [refresh])

    const moveModule = (action)=>{
        if(action === 'advance'){
            modules.map((value, index)=>{
                if(value.id == currentModule.id){
                    navigate(`/courses/taken/${course.slug}/${modules[index+1].slug}`)
                }
            })
        }else{
            modules.map((value, index)=>{
                if(value.id == currentModule.id){
                    navigate(`/courses/taken/${course.slug}/${modules[index-1].slug}`)
                }
            })
        }

        setRefresh(refresh+1)

    }

    const updateModuleStateFinish = (slug)=>{
        //get module
        const data = {
            'slug': slug,
        }
        axios.post(`${ROOT_URL}/api/update-module-state-finish`, data, header)
        .then((response)=>{
            if(response.data.module){
            }else{
            }
        })
        .catch((error)=>{
            console.log(error);
        })
        setRefresh(refresh+1);
    }

    const updateModuleStateUnFinish = (slug)=>{
        //get module
        const data = {
            'slug': slug,
        }
        axios.post(`${ROOT_URL}/api/update-module-state-unfinish`, data, header)
        .then((response)=>{
            if(response.data.module){
            }else{
            }
        })
        .catch((error)=>{
            console.log(error);
        })
        setRefresh(refresh+1);
    }

    const changeModule = (slug)=>{
        navigate(`/courses/taken/${course.slug}/${slug}`); setRefresh(refresh+1)
    }

    return (
        <div className="max-w-sm md:max-w-6xl my-8 mx-auto">
            <div className="md:flex justify-between gap-10 items-start">
                <div className="md:w-8/12">
                    {
                        course.type == 'onlineclass' && (
                            <div className='mb-4'>
                                <a href={`${ROOT_URL}/courses/${course.slug}/test`} target='_blank'>
                                    <button className='text-lg font-bold bg-etudes-orange text-white py-2 w-full rounded-lg italic hover:scale-110 duration-300'>
                                        Passer le test
                                        <i className="icofont-read-book pl-2"></i>
                                    </button>
                                </a>
                            </div>
                        )
                    }
                    <div className='text-4xl font-semibold text-etudes-blue'>
                        {course.title}
                    </div>

                    <div className='flex items-center flex-wrap gap-4 my-2'>
                        {
                            courseDomaines.map((value, index)=>{
                                return (
                                    <span key={index} className='capitalize py-0.5 px-2 bg-green-600 text-white rounded-lg text-smfont-medium'>{value.label}</span>
                                )
                            })
                        }
                    </div>

                    <div className='text-2xl font-medium text-etudes-blue my-8'>
                        Module 01 : {currentModule && currentModule.title}
                    </div>

                    <div className='my-4'>
                        <iframe className='w-full rounded-lg shadow-lg' height={500} src={currentModule && currentModule.youtube} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <div className='text-xs md:text-base mt-10 grid grid-cols-4 divide-x divide-gray-400 border border-gray-400 rounded-lg bg-gray-200'>

                        <button className={`rounded-l-lg py-3 flex justify-center gap-2 items-center transition-all duration-300 ease-in font-semibold ${tabActive=='description' && 'text-white bg-etudes-blue'}`} onClick={()=>{setTabActive('description')}}>
                            <i className="icofont-read-book text-xs md:text-lg"></i>
                            <span>Description</span>
                        </button>

                        <button className={`py-3 flex justify-center gap-2 items-center transition-all duration-300 ease-in font-semibold ${tabActive=='document' && 'text-white  bg-etudes-blue'}`} onClick={()=>{setTabActive('document')}}>
                            <i className="icofont-bricks text-xs md:text-lg"></i>
                            <span>Document</span>
                        </button>

                        <button disabled={modules && currentModule && currentModule.id === firstModule.id} className={`py-3 flex justify-center gap-2 items-center transition-all duration-300 ease-in font-semibold ${tabActive=='previous' && 'text-white bg-etudes-blue'}`} onClick={()=>{setTabActive('previous'); moveModule('backoff')}}>
                            <i className="icofont-ui-previous text-xs md:text-lg"></i>
                            <span>Précédent</span>
                        </button>

                        <button disabled={modules && currentModule && currentModule.id === lastModule.id} className={`rounded-r-lg py-3 flex justify-center gap-2 items-center transition-all duration-300 ease-in font-semibold ${tabActive=='next' && 'text-white bg-etudes-blue'}`} onClick={()=>{setTabActive('next'); moveModule('advance')}}>
                            <span>Suivant</span>
                            <i className="icofont-ui-next text-xs md:text-lg "></i>
                        </button>
                    </div>

                    {tabActive === 'description' &&
                        <div className='border border-gray-300 mt-4 rounded-lg p-4'>
                            {renderHTML(currentModule.description)}
                        </div>
                    }

                    {tabActive === 'document' &&
                        <div className="tab-content my-4">
                            <ul className="space-y-4 border p-2 rounded-lg font-semibold text-sm md:text-base">
                                {
                                    modules.map((value, index)=>{
                                        return(
                                            <Accordion number={(index+1) < 10 ? '0'+(index+1) : index+1} title={value.title} duration={(value.duration/60).toFixed(1)}>
                                                <div className='space-y-3'>
                                                    {
                                                        value.media.map((value, index)=>{
                                                            return (
                                                                    value.collection_name === 'documents' && (
                                                                        <div key={index}>
                                                                            <a href={value.original_url} target='_blank' className='flex justify-left gap-2 items-center'>
                                                                                <i class="icofont-document-folder text-etudes-blue text-lg"></i>
                                                                                <span className='capitalize'>{value.name}</span>
                                                                            </a>
                                                                        </div>
                                                                    )
                                                                )

                                                        })
                                                    }
                                                </div>
                                            </Accordion>
                                        )
                                    })
                                }
                            </ul>
                        </div>
                    }
                </div>

                <div className="mt-10 md:mt-0 md:w-4/12">
                    <div className='mb-1 mt-4 flex justify-between items-center px-2'>
                        <span className='text-lg font-bold text-etudes-blue'>
                            { modulesFinished ? (modulesFinished.length/modules.length)*100 : 0}%
                        </span>
                        {modulesFinished && (modulesFinished.length/modules.length)*100 == 100 &&
                            <i className="icofont-trophy text-5xl text-etudes-orange animate__animated animate__bounceInDown"></i>
                        }
                    </div>
                    <div className='rounded-xl bg-gray-200' style={{'height': "1.2em"}}>
                        <div className='rounded-xl bg-green-500' style={{'height': "1.2em", 'width': `${modulesFinished ? (modulesFinished.length/modules.length)*100 : 0}%`}}>
                        </div>
                    </div>
                    {
                        course.type == 'onlineclass' && (
                            <div className='my-4'>
                                <a href={`${ROOT_URL}/courses/${course.slug}/test`}>
                                    <button className='py-2 w-full text-white rounded-lg bg-etudes-orange font-bold text-xl md:hidden'>Passer le test</button>
                                </a>
                            </div>
                        )
                    }

                    <div className='mt-4 space-y-4'>
                            {
                                modules.map((value, index)=>{
                                    return (
                                        <ModuleAccordion number={(index+1) < 10 ? '0'+(index+1) : index+1} active={currentModule.id == value.id} finished={value.users[0].state}>
                                            <div className='px-6'>
                                                <div className="flex justify-between items-center text-lg">
                                                    <i className="icofont-video-cam"></i>
                                                    <span className='font-light text-gray-600 text-sm'>{value.duration} min</span>
                                                </div>
                                                <hr className='my-2'/>
                                                <div className='text-center text-xl font-medium mb-4 text-etudes-blue'>
                                                    <a onClick={()=>changeModule(value.slug)} className='select-none cursor-pointer'>
                                                        {value.title}
                                                    </a>
                                                </div>
                                            </div>
                                            { value.users[0].state === 1 ? (
                                                    <button className={`w-full py-4 rounded-b-xl font-bold text-lg bg-etudes-orange text-white`}  onClick={()=>{updateModuleStateUnFinish(value.slug)}}>
                                                        Terminer
                                                    </button>
                                                ) : (
                                                    <button className={`w-full py-4 rounded-b-xl font-bold text-lg bg-gray-300 text-gray-600`} onClick={()=>{updateModuleStateFinish(value.slug)}}>
                                                        Marquer comme terminé
                                                    </button>
                                                )
                                            }
                                        </ModuleAccordion>
                                    )
                                })
                            }
                        </div>
                        <div className="my-8 md:my-6 bg-white rounded-lg shadow-lg shadow-etudes-blue">
                            <div className="text-center uppercase font-medium text-etudes-blue text-xl p-4">
                                Proposé par
                            </div>
                            <div class="mt-4">
                                <img src={office.img} class="mx-auto h-36 py-5" alt=""/>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    )
}
