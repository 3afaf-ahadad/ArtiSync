import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // L'URL de ton backend Laravel
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  withCredentials: true, // Crucial pour que Sanctum fonctionne
});

export default api;