import axios from 'axios';
import React, {useState, useEffect} from 'react'
import CropEasy from './crop/CropEasy';
export default function Personal(props) {
    const [refresh, setRefresh] = useState(1);
    const [image, setImage] = useState({
        url:'',
        file: null,
    });
    const [openCrop, setOpenCrop] = useState(false);
    const saveImage = (e)=>{
        const file = e.target.files[0];
        if(file){
            setImage({
                url: URL.createObjectURL(file),
                file: file,
            });
            setOpenCrop(true);
        }
    }

    const [firstName, setFirstName] = useState();
    const saveFirstName = (e)=>{
        let data = props.data;
        setFirstName(e.target.value);
        data.personal.first_name = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [lastName, setLastName] = useState('');
    const saveLastName = (e)=>{
        let data = props.data;
        data.personal.last_name = e.target.value;
        setLastName(e.target.value);
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [email, setEmail] = useState('');
    const saveEmail = (e)=>{
        let data = props.data;
        setEmail(e.target.value);
        data.personal.email = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [title, setTitle] = useState('');
    const saveTitle = (e)=>{
        let data = props.data;
        setTitle(e.target.value);
        data.personal.title = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [phone, setPhone] = useState('');
    const savePhone = (e)=>{
        let data = props.data;
        setPhone(e.target.value);
        data.personal.phone = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [address, setAddress] = useState('');
    const saveAddress = (e)=>{
        let data = props.data;
        setAddress(e.target.value);
        data.personal.address = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [birthDate, setBirthDate] = useState('');
    const savePostalCode = (e)=>{
        let data = props.data;
        data.personal.birth_date = e.target.value;
        setBirthDate(e.target.value)
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [city, setCity] = useState('');
    const saveCity = (e)=>{
        let data = props.data;
        setCity(e.target.value)
        data.personal.city = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [facebook, setFacebook] = useState('');
    const saveFacebook = (e)=>{
        let data = props.data;
        setFacebook(e.target.value)
        data.personal.facebook = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [twitter, setTwitter] = useState('');
    const saveTwitter = (e)=>{
        let data = props.data;
        setTwitter(e.target.value)
        data.personal.twitter = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [linkedin, setLinkedin] = useState('');
    const saveLinkedin = (e)=>{
        let data = props.data;
        setLinkedin(e.target.value)
        data.personal.linkedin = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [skype, setSkype] = useState('');
    const saveSkype = (e)=>{
        let data = props.data;
        setSkype(e.target.value)
        data.personal.skype = e.target.value;
        props.setData(data);
        props.setRefresh(props.refresh+1)
    }

    const [description, setDescription] = useState('');
    const saveDescription = (e)=>{
        let data = props.data;
        setDescription(e.target.value);
        data.personal.description = e.target.value;
        props.setData(data);
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
                // setFirstName(JSON.parse(response.data.resume.data.personal.first_name));
                const transit = JSON.parse(response.data.resume.data);
                setFirstName(transit.personal.first_name);
                setLastName(transit.personal.last_name);
                setEmail(transit.personal.email);
                setTitle(transit.personal.title);
                setPhone(transit.personal.phone);
                setAddress(transit.personal.address);
                setBirthDate(transit.personal.birth_date)
                setCity(transit.personal.city)
                setFacebook(transit.personal.facebook)
                setTwitter(transit.personal.twitter)
                setLinkedin(transit.personal.linkedin)
                setSkype(transit.personal.skype)
                setDescription(transit.personal.description)
                if(response.data.resume.image){
                    setImage({
                        file: null,
                        url: response.data.resume.image,
                    })
                    let middle = props.data
                    middle.personal.image = response.data.resume.image;
                    props.setData(middle);
                }
            }
        })
        .catch((error)=>{
            console.log(error);
        })

    }, [refresh])


    return (
        <>
            <div className='p-4'>
                <div className='md:flex items-stretch justify-between gap-4 mt-4'>
                    {
                        openCrop ? (
                            <CropEasy photoURL={image.url} setOpenCrop={setOpenCrop} handleImage={setImage} setData={props.setData} data={props.data} setRefresh={props.setRefresh} refresh={props.refresh}/>
                        ):(
                                image.url ? (
                                    <div className='md:w-3/12'>
                                        <img src={image.url} alt=""  />
                                        <div className='text-center text-red-600 pt-2'>
                                            <i className="icofont-delete-alt cursor-pointer p-2" onClick={()=>{setImage({file:null, url:''})}}></i>
                                        </div>
                                    </div>
                                ) : (
                                    <div className='md:w-3/12'>
                                        <label htmlFor="" className=''>Photo</label>
                                        <label className="h-32 mt-1 flex flex-col items-center px-4 py-2 bg-gray-200 border rounded-lg shadow-lg tracking-wide border border-gray-300 hover:border-kalloba cursor-pointer duration-300" onChange={(e)=>{saveImage(e)}}>
                                            <i className="icofont-cloud-upload text-8xl"></i>
                                            <input type='file' className="hidden" />
                                        </label>
                                    </div>
                                )

                        )
                    }
                    <div className='md:w-9/12 md:grid grid-cols-2 gap-2'>
                        <div className='space-y-1 mt-3 md:mt-2'>
                            <label htmlFor="">Prénom</label> <br />
                            <input value={firstName} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-1 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveFirstName(e)}}/>
                        </div>
                        <div className='space-y-1 mt-3 md:mt-2'>
                            <label htmlFor="">Nom de famille</label> <br />
                            <input value={lastName} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-1 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveLastName(e)}}/>
                        </div>
                        <div className='space-y-1 mt-3 md:mt-2 col-span-2'>
                            <label htmlFor="">Adresse e-email</label> <br />
                            <input value={email} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-1 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveEmail(e)}}/>
                        </div>
                    </div>
                </div>
                <div className='space-y-4 mt-4'>
                    <div className='space-y-1'>
                        <label htmlFor="">Titre du profil</label> <br />
                        <input value={title} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveTitle(e)}}/>
                    </div>
                    <div className='space-y-1'>
                        <label htmlFor="">Numéro de téléphone</label> <br />
                        <input value={phone} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{savePhone(e)}}/>
                    </div>
                    <div className='space-y-1'>
                        <label htmlFor="">Adresse</label> <br />
                        <input value={address} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveAddress(e)}}/>
                    </div>
                    <div className='md:grid grid-cols-2 space-y-4 md:space-y-0 gap-4'>
                        <div className='space-y-1'>
                            <label htmlFor="">Date de naissane</label> <br />
                            <input value={birthDate} type="date" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] focus:outline-none border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{savePostalCode(e)}}/>
                        </div>
                        <div className='space-y-1'>
                            <label htmlFor="">Ville</label> <br />
                            <input value={city} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveCity(e)}}/>
                        </div>
                        <div className='space-y-1'>
                            <label htmlFor="">Facebook</label> <br />
                            <input value={facebook} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveFacebook(e)}}/>
                        </div>
                        <div className='space-y-1'>
                            <label htmlFor="">Twitter</label> <br />
                            <input value={twitter} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveTwitter(e)}}/>
                        </div>
                        <div className='space-y-1'>
                            <label htmlFor="">Linkedin</label> <br />
                            <input value={linkedin} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveLinkedin(e)}}/>
                        </div>
                        <div className='space-y-1'>
                            <label htmlFor="">Skype</label> <br />
                            <input value={skype} type="text" className='focus:outline-none focus:border-etudes-blue focus:bg-etudes-blue/[.1] border py-2 px-2 rounded bg-gray-100 w-full' onInput={(e)=>{saveSkype(e)}}/>
                        </div>
                    </div>

                    <div>
                        <label>Description</label>
                        <textarea value={description} cols="30" rows="2" className={`mt-1 bg-gray-100 border rounded w-full p-2 focus:outline-none focus:outline-etudes-blue focus:bg-etudes-blue/[.1]`} onInput={(e)=>{saveDescription(e)}}></textarea>
                    </div>
                </div>
            </div>
        </>
    )
}
