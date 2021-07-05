import i18n from 'i18next';
import {initReactI18next} from 'react-i18next';
import {I18nManager} from 'react-native';
const resources = {
  de: require('./de.json'),
  en: require('./en.json'),
  es: require('./es.json'),
  et: require('./et.json'),
  fa: require('./fa.json'),
  fr: require('./fr.json'),
  id: require('./id.json'),
  it: require('./it.json'),
  nl: require('./nl.json'),
  pl: require('./pl.json'),
  pt: require('./pt.json'),
  'pt-br': require('./pt-br.json'),
  ro: require('./ro.json'),
  ru: require('./ru.json'),
  th: require('./th.json'),
  tr: require('./tr.json'),
  'zh-cn': require('./zh-cn.json'),
  'zh-tw': require('./zh-tw.json'),
  ar: require('./ar.json'),
};
i18n.use(initReactI18next).init({
  resources,
  lng: I18nManager.isRTL ? 'ar' : 'en',
  keySeparator: false,
  interpolation: {
    escapeValue: false,
  },
});
export default i18n;
