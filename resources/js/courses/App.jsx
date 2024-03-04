import React from "react";
import {createRoot} from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Main from "./module/Main";

const App = ()=>{
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/courses/taken/:slug/:module_slug" element={<Main />} />
            </Routes>
        </BrowserRouter>
    )
}

export default App;

if (document.getElementById('app')) {
    const container = document.getElementById('app');
    const root = createRoot(container);
    root.render(<App />);
}
