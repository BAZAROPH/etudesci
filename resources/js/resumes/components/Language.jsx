import React, {useState, useEffect} from 'react'
import SaveButton from './SaveButton';
import Modal from './Modal';
import axios from 'axios';

export default function Language(props) {
    const [refresh, setRefresh] = useState(false);
    const [data, setData] = useState({});

    const levelLabel = [
        'Choisissez',
        'Débutant(e)',
        'Intermédiraire',
        'Bien',
        'Très bien',
        'Excellent',
    ]

    useEffect(() => {
        setData(props.data);
    }, [refresh])


    const [language, setLanguage] = useState('');
    const saveLanguage = (e)=>{
        setLanguage(e.target.value);
    }

    const [level, setLevel] = useState(1);
    const saveLevel = (e)=>{
        setLevel(e.target.value);
    }

    const save = ()=>{
        if(language){
            let middle = data;
            middle.language.push({
                language: language,
                level: level,
            })
            props.setData(middle);
            setLanguage('');
            setLevel(1);
            setRefresh(!refresh);
            props.setRefresh(props.refresh+1)
        }
    }

    // Update
    const [updateIndex, setUpdateIndex] = useState(null);
    const edit = (index)=>{
        setUpdateIndex(index);
        setLanguage(data.language[index].language);
        setLevel(data.level[index].level);
    }
    const cancelUpdate = ()=>{
        setUpdateIndex(null);
        setLanguage('');
        setLevel(1);
    }
    const update = ()=>{
        let middle = data;
        middle.language[updateIndex].language = language;
        middle.language[updateIndex].level = level;
        props.setData(middle);
        cancelUpdate();
        setRefresh(!refresh);
        props.setRefresh(props.refresh+1)
    }

    const [open, setOpen] = useState(false);
    const openModal = (index)=>{
        setOpen(true);
        setDelIndex(index)
    }
    const closeModal = ()=>{
        setOpen(false);
    }

    const [delIndex, setDelIndex] = useState(null);
    const del = ()=>{
        let middle = data;
        middle.language = middle.language.filter((value, i)=> i!== delIndex);
        props.setData(middle);
        cancelUpdate();
        closeModal();
        setRefresh(!refresh)
        props.setRefresh(props.refresh+1)
    }

    const move = (direction, index)=>{
        let middle = data
        if(direction == 'up'){
            let previous = middle.language[index - 1];
            middle.language[index - 1] = middle.language[index];
            middle.language[index] = previous;
            setRefresh(!refresh)
        }else{
            let previous = middle.language[index + 1];
            middle.language[index + 1] = middle.language[index];
            middle.language[index] = previous;
            setRefresh(!refresh)
        }
        props.setRefresh(props.refresh+1)

        props.setData(middle);
    }


    useEffect(() => {
        axios.get(`${ROOT_URL}/api/moncv/get`, {
            headers:{
                "Content-type": 'text/html; charset=UTF-8',
                "Authorization": `Bearer ${localStorage.getItem('token')}`,
            }
        })
        .then((response)=>{
            if(response.data.resume){
                const transit = JSON.parse(response.data.resume.data);
                setData(transit)
            }
        })
        .catch((error)=>{
            console.log(error);
        })

    }, [])

    return (
        <div className='p-4'>
            <div className='border rounded-lg px-4 pb-4 space-y-4'>
                <div className='mt-2 space-y-1'>
                    <label htmlFor="">Langue</label><br />
                    <input value={language} type="text" className={`focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border rounded p-2 w-full ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{saveLanguage(e)}}/>
                </div>

                <div className='mt-2 space-y-1'>
                    <label htmlFor="">Niveau</label><br />
                    <div className="flex items-center gap-4">
                    <input type="range" value={level} step={1} max={5}  className={`w-1/2 focus:outline-none bg-etudes-blue focus:ring-0 ${updateIndex !== null ? 'bg-green-500' : 'bg-etudes-blue'} rounded-xl h-1 appearance-none`} onChange={(e)=>{saveLevel(e)}}/>
                        <span>{levelLabel[level]}</span>
                    </div>
                </div>
                {updateIndex == null ?
                    <SaveButton save={save}/>
                    :
                    <div className='gap-2 flex justify items-center'>
                        <button className='py-2 px-4 rounded bg-red-500 hover:bg-red-600 text-white text-lg duration-300' onClick={()=>{cancelUpdate()}}>Annuler</button>
                        <SaveButton save={update}/>
                    </div>
                }
            </div>

            <div className="mt-4 space-y-4">
                <Modal closeModal={closeModal} open={open} del={del}>
                    <div className='text-center pt-8 text-xl font-semibold text-red-600'>
                        Attention cette action est irréversible
                    </div>
                    <div className='text-5xl text-center pt-2 text-red-600'>
                        <i className="icofont-warning-alt"></i>
                    </div>
                </Modal>
                {data && data.language && data.language.length >=1 &&
                    data.language.map((value, index)=>{
                        return (
                            <div key={index} className="flex gap-4 items-center">
                                <div className='flex flex-col items-center gap-2'>
                                    {
                                        index !== 0 &&
                                        <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('up', index)}}><i class="icofont-caret-up"></i></button>
                                    }
                                    {
                                        index !== data.language.length-1 &&
                                        <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('down', index)}}><i class="icofont-caret-down"></i></button>
                                    }
                                </div>
                                <div className='rounded-xl border border-etudes-blue p-3 w-full'>
                                    <div className="flex justify-between items-center">
                                        <div className='w-3/4'>
                                            <div className='font-semibold text-lg'>{index+1} - {value.language}</div>
                                            <div className='line-clamp-1 mt-1 text-gray-500'>Niveau :  <span className='font-bold text-etudes-blue'>{value.level}/5</span></div>
                                        </div>
                                        <div className='flex items-center justify-between gap-2'>
                                            <button className='px-2 py-1 border rounded-lg hover:text-etudes-blue hover:border-etudes-blue hover:bg-etudes-blue/[.1] duration-300' onClick={()=>{edit(index)}}>Modifier</button>
                                            <button className='px-2 py-1 border rounded-lg hover:border-red-500 hover:bg-red-500/[.1] duration-300' onClick={()=>{openModal(index)}}>Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )
                    })
                }
            </div>
        </div>
    )
}
