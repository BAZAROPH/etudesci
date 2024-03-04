import React, {useState, useEffect} from 'react'
import SaveButton from './SaveButton';
import Modal from './Modal';
import axios from 'axios';

export default function Interest(props) {
    const [refresh, setRefresh] = useState(false);
    const [data, setData] = useState();
    useEffect(() => {
        setData(props.data)
    }, [refresh])

    const [interest, setInterest] = useState('');
    const saveInterest = (e)=>{
        setInterest(e.target.value);
    }

    const save = ()=>{
        if(interest){
            let middle = data;
            middle.interest.push(interest);
            props.setData(middle);
            setInterest('');
            setRefresh(!refresh);
            props.setRefresh(props.refresh+1)
        }
    }

    //Update
    const [updateIndex, setUpdateIndex] = useState(null);
    const edit = (index)=>{
        setUpdateIndex(index);
        setInterest(data.interest[index]);
    }
    const cancelUpdate = ()=>{
        setUpdateIndex(null);
        setInterest('');
    }

    const update  = ()=>{
        let middle = data;
        middle.interest[updateIndex] = interest;
        props.setData(middle)
        cancelUpdate();
        setRefresh(!refresh);
        props.setRefresh(props.refresh+1)
    }

    const [open, setOpen] = useState(false);
    const openModal = (index)=>{
        setOpen(true);
        setDelIndex(index);
    }
    const closeModal = ()=>{
        setOpen(false);
    }

    const [delIndex, setDelIndex] = useState(null);
    const del = ()=>{
        let middle = data;
        middle.interest = middle.interest.filter((value, i)=> i!== delIndex);
        props.setData(middle);
        cancelUpdate();
        closeModal();
        setRefresh(!refresh)
        props.setRefresh(props.refresh+1)
    }

    const move = (direction, index)=>{
        let middle = data
        if(direction == 'up'){
            let previous = middle.interest[index - 1];
            middle.interest[index - 1] = middle.interest[index];
            middle.interest[index] = previous;
            setRefresh(!refresh)
        }else{
            let previous = middle.interest[index + 1];
            middle.interest[index + 1] = middle.interest[index];
            middle.interest[index] = previous;
            setRefresh(!refresh)
        }

        props.setData(middle);
        props.setRefresh(props.refresh+1)
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
                    <label htmlFor="">Intérêt</label><br />
                    <input value={interest} type="text" className={`focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border rounded p-2 w-full ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{saveInterest(e)}}/>
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
                {data && data.interest && data.interest.length >=1 &&
                    data.interest.map((value, index)=>{
                        return (
                            <div key={index} className="flex gap-4 items-center">
                                <div className='flex flex-col items-center gap-2'>
                                    {
                                        index !== 0 &&
                                        <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('up', index)}}><i class="icofont-caret-up"></i></button>
                                    }
                                    {
                                        index !== data.interest.length-1 &&
                                        <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('down', index)}}><i class="icofont-caret-down"></i></button>
                                    }
                                </div>
                                <div className='rounded-xl border border-etudes-blue p-3 w-full'>
                                    <div className="flex justify-between items-center">
                                        <div className='w-3/4'>
                                            <div className='font-semibold text-lg'>{index+1} - {value}</div>
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
