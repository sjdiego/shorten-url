import React from 'react';

function ToggleButton() {
    const handleChange = () => {
        document.querySelector('#shortenerOptions').classList.toggle('hidden')
    }

    return (
        <div className="flex flex-row items-center justify-center">
            <div className="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                <input 
                    id="toggle" 
                    name="toggle" 
                    type="checkbox"
                    onClick={handleChange}
                    className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                <label 
                    htmlFor="toggle" 
                    className="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer" />
            </div>            
            <label htmlFor="toggle" className="text-xs text-gray-700">Show options</label>
        </div>
    )

}

export default ToggleButton;
