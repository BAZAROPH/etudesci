import React, {useState, useEffect} from 'react'
import SaveButton from './SaveButton';
import Modal from './Modal';
import axios from 'axios';

export default function Xp(props) {
    const [data, setData] = useState({});
    const [refresh, setRefresh] = useState(1);
    useEffect(() => {
        setData(props.data)
    }, [refresh])


    const months = [
        'janvier',
        'février',
        'mars',
        'avril',
        'mai',
        'juin',
        'juillet',
        'août',
        'septembre',
        'octobre',
        'novembre',
        'décembre',
    ];
    const years = [
        '2023',
        '2022',
        '2021',
        '2020',
        '2019',
        '2018',
        '2017',
        '2016',
        '2015',
        '2014',
        '2013',
        '2012',
        '2011',
        '2010',
        '2009',
        '2008',
        '2007',
        '2006',
        '2005',
        '2004',
        '2003',
        '2002',
        '2001',
        '2000',
        '1999',
        '1998',
        '1997',
        '1996',
        '1995',
        '1994',
        '1993',
        '1992',
        '1991',
        '1990',
        '1989',
        '1988',
        '1987',
        '1986',
        '1985',
        '1984',
        '1983',
        '1982',
        '1981',
        '1980',
        '1979',
        '1978',
        '1977',
        '1976',
        '1975',
        '1974',
        '1973',
        '1972',
        '1971',
        '1970',
        '1969',
        '1968',
        '1967',
        '1966',
        '1965',
        '1964',
        '1963',
    ]

    const [post, setPost]  = useState('');
    const savePost = (e)=>{
        setPost(e.target.value);
    }

    const [company, setCompany]  = useState('');
    const saveCompany= (e)=>{
        setCompany(e.target.value);
    }

    const [city, setCity]  = useState('');
    const saveCity= (e)=>{
        setCity(e.target.value);
    }

    const [beginDate, setBeginDate] = useState({
        month: null,
        year: null,
    })

    const saveBeginDateMonth = (e)=>{
        let middle = beginDate;
        middle.month = e.target.value;
        setBeginDate(middle);
    }

    const saveBeginDateYear = (e)=>{
        let middle = beginDate;
        middle.year = e.target.value;
        setBeginDate(middle);
    }

    const [endDate, setEndDate] = useState({
        month: null,
        year: null,
    })

    const saveEndDateMonth = (e)=>{
        let middle = endDate;
        middle.month = e.target.value;
        setEndDate(middle);
    }

    const saveEndDateYear = (e)=>{
        let middle = endDate;
        middle.year = e.target.value;
        setEndDate(middle);
    }

    const [description, setDescription] = useState('');
    const saveDescription = (e)=>{
        setDescription(e.target.value);
    }

    const save = ()=>{
        if(post){
            let data = props.data;
            let xp = data.xp;
            xp.push(
                {
                    post: post,
                    company: company,
                    city: city,
                    begin_month: beginDate.month,
                    begin_year: beginDate.year,
                    end_month: endDate.month,
                    end_year: endDate.year,
                    description: description,
                }
            )
            data.xp = xp;
            props.setData(data);
            setPost('');
            setCompany('');
            setCity('');
            setBeginDate({
                month: null,
                year: null,
            });
            setEndDate({
                month: null,
                year: null,
            });
            setDescription('');
            setRefresh(refresh+1)
            props.setRefresh(props.refresh+1)
        }
    }


    // Update
    const [updateIndex, setUpdateIndex] = useState(null);
    const edit = (index)=>{
        setUpdateIndex(index)
        setPost(props.data.xp[index].post);
        setCompany(props.data.xp[index].company);
        setCity(props.data.xp[index].city);
        setBeginDate({
            month: props.data.xp[index].begin_month,
            year: props.data.xp[index].begin_year,
        });
        setEndDate({
            month: props.data.xp[index].end_month,
            year: props.data.xp[index].end_year,
        });
        setDescription(props.data.xp[index].description);
    }

    const cancelUpdate = ()=>{
        setUpdateIndex(null);
        setPost('');
        setCompany('');
        setCity('');
        setBeginDate({
            month: null,
            year: null,
        });
        setEndDate({
            month: null,
            year: null,
        });
        setDescription('');
    }

    const update = ()=>{
        if(post){
            let data = props.data;
            let xp = data.xp;
            xp[updateIndex].post = post;
            xp[updateIndex].company = company;
            xp[updateIndex].city = city;
            xp[updateIndex].begin_month = beginDate.month;
            xp[updateIndex].begin_year = beginDate.year;
            xp[updateIndex].end_month = endDate.month;
            xp[updateIndex].end_year = endDate.year;
            xp[updateIndex].description = description;
            data.xp = xp
            props.setData(data);
            cancelUpdate();
            setRefresh(refresh+1)
            props.setRefresh(props.refresh+1)
        }
    }

    const [delIndex, setDelIndex] = useState(null);
    const del = ()=>{
            let data = props.data;
            let xp = data.xp;

            xp = xp.filter((value, i)=> delIndex !== i);

            data.xp = xp
            console.log(data.xp);
            props.setData(data);
            cancelUpdate();
            closeModal();
            setRefresh(!refresh);
            props.setRefresh(props.refresh+1)
    }

    const [open, setOpen] = useState(false);
    const openModal = (index)=>{
        setDelIndex(index)
        setOpen(true);
    }
    const closeModal = ()=>{
        setOpen(false);
    }

    const move = (direction, index)=>{
        let middle = data
        if(direction == 'up'){
            let previous = middle.xp[index - 1];
            middle.xp[index - 1] = middle.xp[index];
            middle.xp[index] = previous;
            setRefresh(!refresh)
        }else{
            let previous = middle.xp[index + 1];
            middle.xp[index + 1] = middle.xp[index];
            middle.xp[index] = previous;
            setRefresh(refresh+1);
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
            <div className='border rounded-lg px-4 pb-4 space-y-4 relative'>
                <div className='mt-2 space-y-1'>
                    <label htmlFor="">Poste</label><br />
                    <input value={post} type="text" className={`focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border rounded p-2 w-full ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{savePost(e)}}/>
                </div>
                <div className="grid grid-cols-2 gap-4">
                    <div className=' space-y-1'>
                        <label htmlFor="">Entreprise</label><br />
                        <input value={company} type="text" className={`focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border rounded p-2 w-full ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{saveCompany(e)}}/>
                    </div>
                    <div className=' space-y-1'>
                        <label htmlFor="">Ville</label><br />
                        <input value={city} type="text" className={`focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border rounded p-2 w-full ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{saveCity(e)}}/>
                    </div>
                </div>
                <div className='grid grid-cols-2 gap-4'>
                    <div>
                        <label>Date de début</label>
                        <div className="grid grid-cols-2 gap-2">
                            <select value={beginDate.month} id="" className={`border rounded p-2 w-full focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onChange={(e)=>{saveBeginDateMonth(e)}}>
                                <option value="" className="bg-white text-gray-400">Mois</option>
                                {months.map((month, index)=>{
                                    return <option key={index} value={index+1<10 ? '0'+(index+1) : index+1} className="bg-white text-gray-800 capitalize">{month}</option>
                                })}

                            </select>
                            <select value={beginDate.year} id="" className={`border rounded p-2 w-full focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onChange={(e)=>{saveBeginDateYear(e)}}>
                                <option value="" className="bg-white text-gray-400">Année</option>
                                {years.map((year, index)=>{
                                    return <option key={index} value={year} className="bg-white text-gray-800">{year}</option>
                                })}
                            </select>
                        </div>
                    </div>
                    <div>
                        <label>Date de fin</label>
                        <div className="grid grid-cols-2 gap-2">
                            <select value={endDate.month} id="" className={`border rounded p-2 w-full focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onChange={(e)=>{saveEndDateMonth(e)}}>
                                <option value="" className="bg-white text-gray-400">Mois</option>
                                {months.map((month, index)=>{
                                    return <option key={index} value={index+1<10 ? '0'+(index+1) : index+1} className="bg-white text-gray-800 capitalize">{month}</option>
                                })}
                            </select>
                            <select value={endDate.year} id="" className={`border rounded p-2 w-full focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onChange={(e)=>{saveEndDateYear(e)}}>
                                <option value="" className="bg-white text-gray-400">Année</option>
                                {years.map((year, index)=>{
                                    return <option key={index} value={year} className="bg-white text-gray-800">{year}</option>
                                })}
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <label>Description</label>
                    <textarea value={description} cols="30" rows="2" className={`mt-1 border rounded w-full p-2 focus:outline-none focus:outline-etudes-blue focus:bg-etudes-blue/[.1] ${updateIndex !== null ? 'bg-green-100' : 'bg-gray-100'}`} onInput={(e)=>{saveDescription(e)}}></textarea>
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

            {props.data.xp.length >= 1 &&
                <div className=' mt-4 space-y-4'>
                    <Modal closeModal={closeModal} open={open} del={del}>
                        <div className='text-center pt-8 text-xl font-semibold text-red-600'>
                            Attention cette action est irréversible
                        </div>
                        <div className='text-5xl text-center pt-2 text-red-600'>
                            <i className="icofont-warning-alt"></i>
                        </div>
                    </Modal>
                    {
                        data && data.xp && data.xp.map((value, index)=>{
                            return (
                                <div key={index} className="flex gap-4 items-center">
                                    <div className='flex flex-col items-center gap-2'>
                                        {
                                            index !== 0 &&
                                            <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('up', index)}}><i className="icofont-caret-up"></i></button>
                                        }
                                        {
                                            index !== data.xp.length-1 &&
                                            <button className={`duration-300 hover:bg-etudes-blue hover:text-white p-y-1 px-2 rounded-lg bg-gray-200 text-etudes-blue`} onClick={()=>{move('down', index)}}><i className="icofont-caret-down"></i></button>
                                        }
                                    </div>
                                    <div className='rounded-xl border border-etudes-blue p-3 w-full'>
                                        <div className="flex justify-between items-center">
                                            <div className='w-3/4'>
                                                <div className='font-semibold text-lg'>{index+1} - {value.post}</div>
                                                <div className='line-clamp-1 mt-1 text-gray-500'>{value.description}</div>
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
            }
        </div>
    )
}
