import axios from 'axios';
export const configureAxios = () => {
  axios.defaults.baseURL = 'https://extremelab.tech/api/';
  axios.defaults.headers.Accept = 'application/json';
  axios.defaults.headers.post['Content-Type'] =
    'application/x-www-form-urlencoded';
  axios.defaults.headers.get['Content-Type'] = 'application/json';
};
export const API_ENDPOINTS = {
  login: 'login',
  forgetPatientCode: 'forget_code',
  register: 'register',
  getAllLabBranches: 'patient/branches',
  updatePatientDate: 'patient/update_profile',
  reserveHomeVisit: 'patient/visit',
  getpatientDashboard: 'patient/dashboard',
  getPatientGroupTests: 'patient/group_tests',
};
export const TOKEN_KEY = 'EXTREMELAB.Keys.TOKEN';
export const USER_KEY = 'EXTREMELAB.Keys.USER';
export const LANGUAGE_KEY = 'EXTREMELAB.Keys.LANGUAGE';
