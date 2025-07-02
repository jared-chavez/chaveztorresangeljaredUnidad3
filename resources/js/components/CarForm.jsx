import React, { useState, useEffect } from 'react';

function CarForm({ car, onSubmit, onCancel, validateInput, showError, clearError }) {
    const [formData, setFormData] = useState({
        brand: '',
        model: '',
        year: new Date().getFullYear()
    });
    const [errors, setErrors] = useState({});

    // Initialize form with car data if editing
    useEffect(() => {
        if (car) {
            setFormData({
                brand: car.brand || '',
                model: car.model || '',
                year: car.year || new Date().getFullYear()
            });
        }
    }, [car]);

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));

        // Clear error when user starts typing
        if (errors[name]) {
            setErrors(prev => ({
                ...prev,
                [name]: ''
            }));
        }
    };

    const validateForm = () => {
        const newErrors = {};
        let isValid = true;

        // Validate brand
        if (!formData.brand.trim()) {
            newErrors.brand = 'Brand is required';
            isValid = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/.test(formData.brand.trim())) {
            newErrors.brand = 'Brand can only contain letters and spaces';
            isValid = false;
        }

        // Validate model
        if (!formData.model.trim()) {
            newErrors.model = 'Model is required';
            isValid = false;
        } else if (!/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]+$/.test(formData.model.trim())) {
            newErrors.model = 'Model can only contain letters, numbers, spaces, and hyphens';
            isValid = false;
        }

        // Validate year
        const year = parseInt(formData.year);
        if (isNaN(year)) {
            newErrors.year = 'Year must be a valid number';
            isValid = false;
        } else if (year < 1900 || year > new Date().getFullYear() + 1) {
            newErrors.year = `Year must be between 1900 and ${new Date().getFullYear() + 1}`;
            isValid = false;
        }

        setErrors(newErrors);
        return isValid;
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        
        if (validateForm()) {
            onSubmit(formData);
        } else {
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please correct the errors before submitting.',
                });
            }
        }
    };

    return (
        <div className="bg-white shadow-md rounded-lg p-6 mb-6">
            <div className="flex justify-between items-center mb-6">
                <h2 className="text-xl font-semibold text-gray-800">
                    {car ? 'Edit Car' : 'Add New Car'}
                </h2>
                <button
                    onClick={onCancel}
                    className="text-gray-500 hover:text-gray-700"
                >
                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form onSubmit={handleSubmit} className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label htmlFor="brand" className="block text-sm font-medium text-gray-700 mb-1">
                            Brand *
                        </label>
                        <input
                            type="text"
                            id="brand"
                            name="brand"
                            value={formData.brand}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 ${
                                errors.brand ? 'border-red-500' : 'border-gray-300'
                            }`}
                            placeholder="e.g., Toyota"
                            maxLength="255"
                            required
                        />
                        {errors.brand && (
                            <p className="mt-1 text-sm text-red-600">{errors.brand}</p>
                        )}
                    </div>

                    <div>
                        <label htmlFor="model" className="block text-sm font-medium text-gray-700 mb-1">
                            Model *
                        </label>
                        <input
                            type="text"
                            id="model"
                            name="model"
                            value={formData.model}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 ${
                                errors.model ? 'border-red-500' : 'border-gray-300'
                            }`}
                            placeholder="e.g., Camry"
                            maxLength="255"
                            required
                        />
                        {errors.model && (
                            <p className="mt-1 text-sm text-red-600">{errors.model}</p>
                        )}
                    </div>

                    <div>
                        <label htmlFor="year" className="block text-sm font-medium text-gray-700 mb-1">
                            Year *
                        </label>
                        <input
                            type="number"
                            id="year"
                            name="year"
                            value={formData.year}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 ${
                                errors.year ? 'border-red-500' : 'border-gray-300'
                            }`}
                            min="1900"
                            max={new Date().getFullYear() + 1}
                            required
                        />
                        {errors.year && (
                            <p className="mt-1 text-sm text-red-600">{errors.year}</p>
                        )}
                    </div>
                </div>

                <div className="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        onClick={onCancel}
                        className="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        className="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md transition-colors"
                    >
                        {car ? 'Update Car' : 'Add Car'}
                    </button>
                </div>
            </form>
        </div>
    );
}

export default CarForm; 