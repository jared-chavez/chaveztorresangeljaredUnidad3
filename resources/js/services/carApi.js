/**
 * Car API Service
 * Handles all AJAX requests to the car endpoints
 */

class CarApiService {
    constructor() {
        this.baseUrl = '/api/cars';
        this.headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };
        console.log('🚀 CarApiService initialized with baseUrl:', this.baseUrl);
    }

    /**
     * Get all cars
     * @returns {Promise<Array>} Array of cars
     */
    async getAllCars() {
        try {
            console.log('🔄 Fetching all cars...');
            
            const response = await fetch(this.baseUrl, {
                method: 'GET',
                headers: this.headers
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const cars = await response.json();
            console.log('✅ Cars fetched successfully:', cars);
            
            return cars;
        } catch (error) {
            console.error('❌ Error fetching cars:', error);
            throw error;
        }
    }

    /**
     * Get a single car by ID
     * @param {number} id - Car ID
     * @returns {Promise<Object>} Car object
     */
    async getCarById(id) {
        try {
            console.log(`🔄 Fetching car with ID: ${id}`);
            
            const response = await fetch(`${this.baseUrl}/${id}`, {
                method: 'GET',
                headers: this.headers
            });

            if (!response.ok) {
                if (response.status === 404) {
                    throw new Error('Car not found');
                }
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const car = await response.json();
            console.log('✅ Car fetched successfully:', car);
            
            return car;
        } catch (error) {
            console.error(`❌ Error fetching car ${id}:`, error);
            throw error;
        }
    }

    /**
     * Create a new car
     * @param {Object|FormData} carData - Car data (brand, model, year, modelImg)
     * @param {boolean} isFormData - If true, carData is FormData (for file upload)
     * @returns {Promise<Object>} Created car object
     */
    async createCar(carData, isFormData = false) {
        try {
            console.log('🔄 Creating new car:', carData);
            let options = {
                method: 'POST',
                headers: isFormData ? { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } : this.headers,
                body: isFormData ? carData : JSON.stringify(carData)
            };
            const response = await fetch(this.baseUrl, options);
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }
            const newCar = await response.json();
            console.log('✅ Car created successfully:', newCar);
            return newCar;
        } catch (error) {
            console.error('❌ Error creating car:', error);
            throw error;
        }
    }

    /**
     * Update an existing car
     * @param {number} id - Car ID
     * @param {Object|FormData} carData - Updated car data
     * @param {boolean} isFormData - If true, carData is FormData (for file upload)
     * @returns {Promise<Object>} Updated car object
     */
    async updateCar(id, carData, isFormData = false) {
        try {
            console.log(`🔄 Updating car ${id}:`, carData);
            let options;
            if (isFormData) {
                options = {
                    method: 'POST', // Laravel expects POST with _method=PUT for file upload
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: carData
                };
            } else {
                options = {
                    method: 'PUT',
                    headers: this.headers,
                    body: JSON.stringify(carData)
                };
            }
            const response = await fetch(`${this.baseUrl}/${id}`, options);
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }
            const updatedCar = await response.json();
            console.log('✅ Car updated successfully:', updatedCar);
            return updatedCar;
        } catch (error) {
            console.error(`❌ Error updating car ${id}:`, error);
            throw error;
        }
    }

    /**
     * Delete a car
     * @param {number} id - Car ID
     * @returns {Promise<Object>} Deletion confirmation
     */
    async deleteCar(id) {
        try {
            console.log(`🔄 Deleting car with ID: ${id}`);
            
            const response = await fetch(`${this.baseUrl}/${id}`, {
                method: 'DELETE',
                headers: this.headers
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('✅ Car deleted successfully:', result);
            
            return result;
        } catch (error) {
            console.error(`❌ Error deleting car ${id}:`, error);
            throw error;
        }
    }
}

// Export a singleton instance
const carApi = new CarApiService();
export default carApi; 