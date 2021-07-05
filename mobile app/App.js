/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */
import React, {useEffect, useContext} from 'react';
import {AppConatiner} from './src/navigation/index';
import {Provider as TestResultsProvider} from './src/context/testResultsContext';
import {Provider as UserProvider} from './src/context/userContext';
import {Context as UserContext} from './src/context/userContext';
import axios from 'axios';
import {
  getLanaguageType,
  getUserDataFromLocal,
  getUserTokenFromLocal,
  setLanaguageType,
} from './src/StorageManager';
import './src/I18';
import {Languages} from './src/constants';
import {I18nManager} from 'react-native';
import {useTranslation} from 'react-i18next';
const App = () => {
  const {state, RestoreUserData, setLangaugeContext} = useContext(UserContext);
  const {t, i18n} = useTranslation();

  useEffect(() => {
    (async () => {
      //user data
      let userData = await getUserDataFromLocal();
      console.warn(userData);
      if (userData !== null) {
        await RestoreUserData(userData);
        let token = await getUserTokenFromLocal();
        axios.defaults.headers.Authorization = 'Bearer ' + token;
      }
      //user language
      let userLanguage = await getLanaguageType();
      if (userLanguage === null) {
        await setLanaguageType(Languages[1]);
        await setLangaugeContext(Languages[1]);
      } else {
        await setLangaugeContext(userLanguage);
        switch (userLanguage.label) {
          case 'ar':
            i18n.changeLanguage('ar').then(() => {
              I18nManager.forceRTL(true);
            });
            break;
          case 'de':
            i18n.changeLanguage('de').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'es':
            i18n.changeLanguage('es').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'et':
            i18n.changeLanguage('et').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'fa':
            i18n.changeLanguage('fa').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'fr':
            i18n.changeLanguage('fr').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'id':
            i18n.changeLanguage('id').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'it':
            i18n.changeLanguage('it').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'n1':
            i18n.changeLanguage('n1').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'p1':
            i18n.changeLanguage('p1').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'pt':
            i18n.changeLanguage('pt').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'pt-br':
            i18n.changeLanguage('pt-br').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'ro':
            i18n.changeLanguage('ro').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'ru':
            i18n.changeLanguage('ru').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'th':
            i18n.changeLanguage('th').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'tr':
            i18n.changeLanguage('tr').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'zh-cn':
            i18n.changeLanguage('zh-cn').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          case 'zh-tw':
            i18n.changeLanguage('zh-tw').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
          default:
            i18n.changeLanguage('en').then(async () => {
              I18nManager.forceRTL(false);
            });
            break;
        }
      }

      //Languages
    })();
  }, []);

  return <AppConatiner userData={state.userData} />;
};
const AppWithProvider = () => (
  <UserProvider>
    <TestResultsProvider>
      <App />
    </TestResultsProvider>
  </UserProvider>
);
export default AppWithProvider;
