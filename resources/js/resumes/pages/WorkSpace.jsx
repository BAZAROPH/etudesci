import React, {useState, useEffect} from 'react';
import Preview from '../components/Preview';
import Personal from '../components/Personal';
import Diploma from '../components/Diploma';
import Xp from '../components/Xp';
import Skill from '../components/Skill';
import Language from '../components/Language';
import Interest from '../components/Interest';
import MoveButton from '../components/MoveButton';
import axios from 'axios';
import { useParams } from 'react-router-dom';

export default function WorkSpace() {
    const [refresh, setRefresh] = useState(1)
    const [step, setStep] = useState(0)
    const levels = [
        'Informations personnelles',
        'Formation',
        'Expérience professionelle',
        'Compétences',
        'Langue',
        'Centre d\'intérêt',
    ];
    const {model} = useParams();
    const [data, setData] = useState(
        {
            personal: {
                first_name: "",
                last_name: "",
                email: "",
                title: "",
                phone: "",
                adress: "",
                birth_date: "",
                city: "",
                description: "",
                image: "",
            },
            diploma: [],
            xp: [],
            skill: [],
            language: [],
            interest: [],
            color: '#191f0e',
            font: 'Open Sans',
            model: 1,
            facebook: '',
            linkedin: '',
            twitter: '',
            skype: '',
        }
    )

    useEffect(() => {
        axios.get(`${ROOT_URL}/api/moncv/get`, {
            headers:{
                "Content-type": 'text/html; charset=UTF-8',
                "Authorization": `Bearer ${localStorage.getItem('token')}`,
            }
        })
        .then((response)=>{
            if(response.data.resume){
                setData(JSON.parse(response.data.resume.data));
                console.log(JSON.parse(response.data.resume.data))
            }
        })
        .catch((error)=>{
            console.log(error);
        })

        data.model = model;
    }, [])


    const saveResume = (param, image=null)=>{
        setData(param);
        let formData = new FormData();
        formData.append('data', JSON.stringify(param));
        formData.append('name', 'mon-cv');
        formData.append('image', image);
        axios.post(`${ROOT_URL}/api/moncv/create`, formData, {
            headers:{
                "Content-type": 'text/html; charset=UTF-8',
                "Authorization": `Bearer ${localStorage.getItem('token')}`,
            }
        })
        .then((response)=>{
            if(response.data){
                console.log(response.data);
            }
        })
        .catch((error)=>{
            console.log(error);
        })
    }
    return (
        <div className='grid md:grid-cols-2'>
            <div className='p-2'>
                <MoveButton title={levels[step]} setStep={setStep} step={step} levels={levels}></MoveButton>
                {levels[step] === 'Informations personnelles' &&
                    <Personal data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
                {levels[step] === 'Formation' &&
                    <Diploma data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
                {levels[step] === 'Expérience professionelle' &&
                    <Xp data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
                {levels[step] === 'Compétences' &&
                    <Skill data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
                {levels[step] === 'Langue' &&
                    <Language data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
                {levels[step] === 'Centre d\'intérêt' &&
                    <Interest data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                }
            </div>
            <div className='hidden md:block bg-gray-200'>
                <div className="p-6">
                    <Preview data={data} setData={saveResume} refresh={refresh} setRefresh={setRefresh}/>
                </div>
            </div>
        </div>
    )
}
