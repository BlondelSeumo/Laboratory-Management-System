import AsyncStorage from '@react-native-community/async-storage';
import {LANGUAGE_KEY, TOKEN_KEY, USER_KEY} from '../constants/APIConfig';

// Read & Write user data locally
export const setUserDataToLocal = async (value) => {
  await AsyncStorage.setItem(USER_KEY, JSON.stringify(value));
};
export const getUserDataFromLocal = async () => {
  let value = (await AsyncStorage.getItem(USER_KEY)) || null;
  return JSON.parse(value);
};

//userToken

export const setUserTokenToLocal = async (value) => {
  await AsyncStorage.setItem(TOKEN_KEY, JSON.stringify(value));
};
export const getUserTokenFromLocal = async () => {
  let value = (await AsyncStorage.getItem(TOKEN_KEY)) || null;
  return JSON.parse(value);
};

// Read & Write user language locally

export const setLanaguageType = async (value) => {
  await AsyncStorage.setItem(LANGUAGE_KEY, JSON.stringify(value));
  let t = await getLanaguageType();
  console.warn('After set', t);
};
export const getLanaguageType = async () => {
  let value = (await AsyncStorage.getItem(LANGUAGE_KEY)) || null;
  return JSON.parse(value);
};
