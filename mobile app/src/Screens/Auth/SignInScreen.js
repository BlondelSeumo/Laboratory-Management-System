import React, {useState, useContext, useEffect} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  Image,
  Text,
  Platform,
  ActivityIndicator,
  ImageBackground,
  StatusBar,
  TouchableOpacity,
  I18nManager,
  Keyboard,
} from 'react-native';
import {KeyboardAwareScrollView} from '@codler/react-native-keyboard-aware-scroll-view';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import NetInfo from '@react-native-community/netinfo';
import {
  Styles,
  Images,
  Colors,
  Fonts,
  Languages,
  VALIDATIONTYPES,
} from '../../constants';
import {ExtremeLabButton, ExtremeLabTextInput} from '../../components';
import {Context as UserContext} from '../../context/userContext';
import {encodingURLParams} from '../../Utils/helperFunctions';
import {showErrorMessage} from '../../Utils/FlashMsgs';
import {SinglePickerMaterialDialog} from 'react-native-material-dialog';
import {useTranslation} from 'react-i18next';
import {
  getLanaguageType,
  setLanaguageType,
  setUserTokenToLocal,
} from '../../StorageManager';
import RNRestart from 'react-native-restart';
import {useForm, Controller} from 'react-hook-form';
import {CODE_REGEX} from '../../Utils/ConstantValues';
import axios from 'axios';

const SignInScreen = ({navigation}) => {
  const [patientCode, setPatientCode] = useState('');
  const [loading, setLoading] = useState(false);
  const {state, login, setUserDataContext, setLangaugeContext} = useContext(
    UserContext,
  );
  const [singlePickerVisible, setSinglePickerVisible] = useState(false);
  const [selectedLanguage, setSelectedLanguage] = useState(state.userLanguage);
  const {t, i18n} = useTranslation();
  const {control, handleSubmit, errors} = useForm();

  useEffect(() => {
    if (errors.patientCode?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:codeIsRequired'));
    } else if (errors.patientCode?.type === VALIDATIONTYPES.pattern) {
      showErrorMessage(t('MESSAGES:codeIsNotValid'));
    }
    Keyboard.dismiss();
  }, [errors]);

  const _signIn = async (data) => {
    Keyboard.dismiss();
    setLoading(true);
    let formBody = encodingURLParams({
      code: data.patientCode,
    });
    await login(formBody, async (response, error) => {
      if (!error) {
        setUserDataContext(response.data.body);
        await setUserTokenToLocal(response.data.body.api_token);
        axios.defaults.headers.Authorization =
          'Bearer ' + response.data.body.api_token;
      } else {
        if (!!error.message) {
          showErrorMessage(error.message);
        } else {
          showErrorMessage(getAPIError(error));
        }
      }
    });
    setLoading(false);
  };
  const handleFirstConnectivityChange = (state) => {
    NetInfo.removeEventListener(
      'connectionChange',
      handleFirstConnectivityChange,
    );
    if (state.isConnected) {
      _signIn();
    } else {
      setLoading(false);
      showErrorMessage(t('MESSAGES:checkNetConnection'));
    }
  };
  const CheckConnectivity = (data) => {
    if (Platform.OS === 'android') {
      NetInfo.fetch().then((state) => {
        if (state.isConnected) {
          _signIn(data);
        } else {
          setLoading(false);
          showErrorMessage(t('MESSAGES:checkNetConnection'));
        }
      });
    } else {
      NetInfo.addEventListener(
        'connectionChange',
        handleFirstConnectivityChange,
      );
    }
  };
  const _changeLanguage = async (result) => {
    await setLanaguageType(result.selectedItem);
    await setLangaugeContext(result.selectedItem);
    setSinglePickerVisible(false);
    setSelectedLanguage(result.selectedItem);
    switch (result.selectedItem.label) {
      case 'en':
        i18n.changeLanguage('en').then(async () => {
          I18nManager.forceRTL(false);
        });
        break;
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
        break;
    }
    RNRestart.Restart();
  };

  return (
    <SafeAreaView style={Styles.safeArea_Conatiner}>
      <View style={Styles.view_Container}>
        <StatusBar backgroundColor={Colors.colorMidnightBlue} />
        <ImageBackground
          source={Images.background}
          style={Styles.img_Background}
          resizeMode="stretch">
          {!!selectedLanguage && (
            <TouchableOpacity
              onPress={() => setSinglePickerVisible(true)}
              style={{
                position: 'absolute',
                top: 15,
                right: 15,
                backgroundColor: Colors.colorMidnightBlue,
                width: 30,
                height: 30,
                borderRadius: 10,
                alignItems: 'center',
                justifyContent: 'center',
                zIndex: 1,
              }}>
              <Text
                style={{
                  color: Colors.colorWhite,
                  fontSize: Fonts.size.regular,
                }}>
                {selectedLanguage.label}
              </Text>
            </TouchableOpacity>
          )}
          <SinglePickerMaterialDialog
            title={t('GENERAL:selecetOneLanguage')}
            items={Languages}
            visible={singlePickerVisible}
            selectedItem={selectedLanguage}
            onCancel={() => setSinglePickerVisible(false)}
            onOk={(result) => _changeLanguage(result)}
            cancelLabel={t('GENERAL:cancel')}
            okLabel={t('GENERAL:ok')}
            scrolled={true}
          />
          <KeyboardAwareScrollView
            enableOnAndroid={true}
            extraScrollHeight={150}
            contentContainerStyle={{
              flexGrow: 1,
              justifyContent: 'center',
              alignItems: 'center',
            }}
            keyboardShouldPersistTaps={'handled'}>
            <View style={styles.view_LoginForm}>
              <Image
                style={styles.img_Logo}
                source={Images.Logo}
                resizeMode="stretch"
              />
              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('SIGNIN_SCREEN:patientCode')}
                    keyboardType="phone-pad"
                    returnKeyType={'done'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'key'}
                    iconType={'FontAwesome5'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="patientCode"
                rules={{required: true, pattern: {value: CODE_REGEX}}}
                defaultValue={patientCode}
              />
              <ExtremeLabButton
                ButtonText={t('SIGNIN_SCREEN:signin')}
                onPress={handleSubmit(CheckConnectivity)}
              />
              <TouchableOpacity
                style={styles.btn_ForgetCode}
                onPress={() => navigation.navigate('ForgetCode')}>
                <Text style={styles.txt_ForgetCode}>
                  {t('SIGNIN_SCREEN:forgetCode')}
                </Text>
              </TouchableOpacity>
              <ActivityIndicator
                animating={loading}
                size="large"
                color={Colors.colorAzureRadiance}
              />
            </View>
          </KeyboardAwareScrollView>
          <View
            style={{
              position: 'absolute',
              bottom: 30,
              flexDirection: 'row',
              // marginVertical: 50,
              alignSelf: 'center',
              justifyContent: 'space-between',
            }}>
            <Text>{`${t('SIGNIN_SCREEN:newHere')} `}</Text>
            <TouchableOpacity
              onPress={() => navigation.navigate('SignUpScreen')}>
              <Text style={{color: '#B0041D', fontSize: 15}}>
                {t('SIGNIN_SCREEN:createAnAccount')}
              </Text>
            </TouchableOpacity>
          </View>
        </ImageBackground>
      </View>
    </SafeAreaView>
  );
};
export default SignInScreen;
const styles = StyleSheet.create({
  img_Logo: {
    width: wp('50%'),
    height: hp('15%'),
    marginVertical: 20,
  },
  view_LoginForm: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  btn_ForgetCode: {marginVertical: 10},
  txt_ForgetCode: {
    fontSize: Fonts.size.regular,
    color: '#B0041D',
  },
});
