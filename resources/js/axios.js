import axios from 'axios';

const apiClient = axios.create({
  // Use your environment variable for the backend URL
  baseURL: import.meta.env.VITE_APP_URL || 'http://localhost/OneTeam/public',
  withCredentials: true, // This is crucial for sending cookies
});

// This line makes it available for other files to import
export default apiClient;
