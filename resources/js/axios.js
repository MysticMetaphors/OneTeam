import axios from 'axios';

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_APP_URL //|| 'http://127.0.0.1:8000'
    || 'http://localhost/OneTeam/public'
  ,
  withCredentials: true,
});

export default apiClient;
