import React, {useState, useRef, useEffect} from 'react'
import One from './models/One'
import Two from './models/Two';
import Three from './models/Three';
import Four from './models/Four';
import Five from './models/Five';
import Six from './models/Six';
import Seven from './models/Seven';
import Settings from './Settings'
import { useParams } from 'react-router-dom';
export default function Preview(props) {
    const [color, setColor] = useState('#191f0e');
    const [font, setFont] = useState('');
    const pdfRef = useRef(null);
    const handleDownload = ()=>{
        pdfRef.current.save();
    }
    const {model} = useParams();

    useEffect(() => {
        setColor(props.data.color)
        setFont(props.data.font)
    }, [props.data.color, props.data.font])

    return (
        <div>
            <Settings setColor={setColor} color={color} setFont={setFont} font={font} handleDownload={handleDownload} refresh={props.refresh} setRefresh={props.setRefresh} data={props.data} setData={props.setData}/>
            {model === '1' &&
                <One data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
            {model === '2' &&
                <Two data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
            {model === '3' &&
                <Three data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
            {model === '4' &&
                <Four data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
            {model === '5' &&
                <Five data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
            {model === '6' &&
                <Six data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
             {model === '7' &&
                <Seven data={props.data} color={color} font={font} pdfRef={pdfRef}/>
            }
        </div>
    )
}
