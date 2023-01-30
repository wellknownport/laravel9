import React, {useEffect, useState} from "react";
import ReactDOM from 'react-dom/client';


const App = (props) => {
    const [image, setImage] = useState('');

    useEffect(() => {
        if (parseInt(props.asset_id) !== 0) {
            setImage(`/assets/${props.asset_id}`);
        }
    }, []);
    const onChangeFile = (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.addEventListener('load', (ev) => {
            setImage(ev.target.result);
        });

        reader.readAsDataURL(file);
    }

    return (
        <>
            <input
                id="photo"
                type="file"
                name="photo"
                accept="image/jpeg, image/jpg"
                onChange={(e) => {
                    onChangeFile(e);
                }}
            />
            <div className="preview">
                <img src={image} alt="" />
            </div>
        </>
    )
}
const target = document.getElementById('js-upload-file');
if (target !== null) {
    const root = ReactDOM.createRoot(document.getElementById('js-upload-file'));
    root.render(<App
        asset_id={data.asset_id}
    />)
}
