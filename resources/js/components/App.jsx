import React, { useState, useEffect } from 'react';
import CarList from './CarList';
import CarForm from './CarForm';
import { validateInput, showError, clearError } from '../app';

function App() {
    const [cars, setCars] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [showForm, setShowForm] = useState(false);
    const [editingCar, setEditingCar] = useState(null);

    // API Base URL
    const API_BASE = '/api/cars';

    // Fetch all cars
    const fetchCars = async () => {
        try {
            setLoading(true);
            const response = await fetch(API_BASE);
            if (!response.ok) {
                throw new Error('Failed to fetch cars');
            }
            const data = await response.json();
            setCars(data);
            setError(null);
        } catch (err) {
            setError('Error loading cars: ' + err.message);
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load cars: ' + err.message
                });
            }
        } finally {
            setLoading(false);
        }
    };

    // Create new car
    const createCar = async (carData) => {
        try {
            const response = await fetch(API_BASE, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(carData)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to create car');
            }

            const newCar = await response.json();
            setCars([...cars, newCar]);
            setShowForm(false);
            
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Car created successfully!'
                });
            }
        } catch (err) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to create car: ' + err.message
                });
            }
        }
    };

    // Update car
    const updateCar = async (id, carData) => {
        try {
            const response = await fetch(`${API_BASE}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(carData)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to update car');
            }

            const updatedCar = await response.json();
            setCars(cars.map(car => car.id === id ? updatedCar : car));
            setEditingCar(null);
            
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Car updated successfully!'
                });
            }
        } catch (err) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update car: ' + err.message
                });
            }
        }
    };

    // Delete car
    const deleteCar = async (id) => {
        try {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (result.isConfirmed) {
                const response = await fetch(`${API_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to delete car');
                }

                setCars(cars.filter(car => car.id !== id));
                
                Swal.fire(
                    'Deleted!',
                    'Car has been deleted.',
                    'success'
                );
            }
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to delete car: ' + err.message
            });
        }
    };

    // Load cars on component mount
    useEffect(() => {
        fetchCars();
    }, []);

    return (
        <div className="container mx-auto px-4 py-8">
            <div className="max-w-6xl mx-auto">
                <div className="flex justify-between items-center mb-8">
                    <h1 className="text-3xl font-bold text-gray-800">
                        Car Management System
                    </h1>
                    <button
                        onClick={() => setShowForm(true)}
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Add New Car
                    </button>
                </div>

                {error && (
                    <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {error}
                    </div>
                )}

                {showForm && (
                    <CarForm
                        onSubmit={createCar}
                        onCancel={() => setShowForm(false)}
                        validateInput={validateInput}
                        showError={showError}
                        clearError={clearError}
                    />
                )}

                {editingCar && (
                    <CarForm
                        car={editingCar}
                        onSubmit={(carData) => updateCar(editingCar.id, carData)}
                        onCancel={() => setEditingCar(null)}
                        validateInput={validateInput}
                        showError={showError}
                        clearError={clearError}
                    />
                )}

                <CarList
                    cars={cars}
                    loading={loading}
                    onEdit={setEditingCar}
                    onDelete={deleteCar}
                />
            </div>
        </div>
    );
}

export default App; 