import React from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import List from "./pages/List";
import WorkSpace from "./pages/WorkSpace";
import Share from "./pages/Share";

const App = ()=>{
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/moncv" element={<List/>}/>
                <Route path="/moncv/:model" element={<WorkSpace/>}/>
                <Route path="/mon-cv-en-ligne/:email" element={<Share/>}/>
            </Routes>
        </BrowserRouter>
    )
}

if (document.getElementById('app')) {
    const container = document.getElementById('app');
    const root = createRoot(container);
    root.render(<App />);
}
