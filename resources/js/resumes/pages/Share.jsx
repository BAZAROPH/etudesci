import React, {useState, useEffect} from 'react'
import One from '../components/models/One'
import Two from '../components/models/Two';
import Three from '../components/models/Three';
import Four from '../components/models/Four';
import Six from '../components/models/Six';
import Five from '../components/models/Five';
import Seven from '../components/models/Seven';

export default function Share() {
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
            },
            diploma: [],
            xp: [],
            skill: [],
            language: [],
            interest: [],
            color: '#191f0e',
            font: 'Open Sans',
            model: 1,
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
            }
        })
        .catch((error)=>{
            console.log(error);
        })
    }, [])

    return (
        <div>
            {MODEL === '1' &&
                <One data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '2' &&
                <Two data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '3' &&
                <Three data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '4' &&
                <Four data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '4' &&
                <Four data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '4' &&
                <Four data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '4' &&
                <Four data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '5' &&
                <Five data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '6' &&
                <Six data={data} color={data.color} font={data.font}/>
            }
            {MODEL === '7' &&
                <Seven data={data} color={data.color} font={data.font}/>
            }
        </div>
    )
}
