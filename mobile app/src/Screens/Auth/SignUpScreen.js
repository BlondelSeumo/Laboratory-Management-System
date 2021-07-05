import React, {useState, useContext, useEffect} from 'react';
import {
  StyleSheet,
  SafeAreaView,
  ImageBackground,
  View,
  Platform,
  I18nManager,
  Keyboard,
} from 'react-native';
import {KeyboardAwareScrollView} from '@codler/react-native-keyboard-aware-scroll-view';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import {
  Styles,
  Images,
  Colors,
  Fonts,
  VALIDATIONTYPES,
} from './../../constants';
import {
  ExtremeLabButton,
  CustomHeader,
  ExtremeLabTextInput,
  ExtremeLabDatePicker,
} from '../../components';
import {Context as UserContext} from '../../context/userContext';
import {Icon, Button} from 'native-base';
import RadioForm from 'react-native-simple-radio-button';
import {EMAIL_REGEX, radio_props} from '../../Utils/ConstantValues';
import Spinner from 'react-native-loading-spinner-overlay';
import NetInfo from '@react-native-community/netinfo';
import {encodingURLParams, getGender} from '../../Utils/helperFunctions';
import {
  getAPIError,
  showErrorMessage,
  showSuccessMessage,
} from '../../Utils/FlashMsgs';
import {useTranslation} from 'react-i18next';
import {useForm, Controller} from 'react-hook-form';
import moment from 'moment';
import axios from 'axios';
import {setUserTokenToLocal} from '../../StorageManager';

const SignUpScreen = ({navigation}) => {
  const [loading, setLoading] = useState(false);
  const [accountData, setAccountData] = useState({
    name: '',
    phone: '',
    address: '',
    email: '',
    dob: '',
    gender: 0,
  });
  const {createNewAccount, setUserDataContext} = useContext(UserContext);
  const [didMount, setDidMount] = useState(false);
  const {t} = useTranslation();
  const {control, handleSubmit, errors} = useForm();

  const translateRadioProp = () => {
    radio_props.map((item) => {
      if (item.value === 0) {
        item.label = t('HOMEVISIT_SCREEN:male');
      } else {
        item.label = t('HOMEVISIT_SCREEN:female');
      }
    });
  };
  useEffect(() => {
    if (errors.name?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:nameIsRequired'));
    } else if (errors.phone?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:phoneIsRequired'));
    } else if (errors.email?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:emailIsRequired'));
    } else if (errors.email?.type === VALIDATIONTYPES.pattern) {
      showErrorMessage(t('MESSAGES:emailIsNotValid'));
    } else if (errors.address?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:addressIsRequired'));
    } else if (errors.dob?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:dobIsRequired'));
    }
    Keyboard.dismiss();
  }, [errors]);

  useEffect(() => {
    translateRadioProp();
    setDidMount(true);
    return () => setDidMount(false);
  }, []);

  if (!didMount) {
    return null;
  }

  const _createPatientAccount = async (data) => {
    Keyboard.dismiss();
    setLoading(true);
    let bodyForm = encodingURLParams({
      ...accountData,
      name: data.name,
      phone: data.phone,
      email: data.email,
      address: data.address,
      dob: moment(data.dob).format('DD-MM-YYYY'),
      gender: getGender(accountData.gender),
    });
    await createNewAccount(bodyForm, async (response, error) => {
      if (!error) {
        showSuccessMessage(t('MESSAGES:createNewAccountSuccessfully'));
        setUserDataContext(response.data.body.patient);
        await setUserTokenToLocal(response.data.body.patient.api_token);
        axios.defaults.headers.Authorization =
          'Bearer ' + response.data.body.patient.api_token;
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
      _createPatientAccount();
    } else {
      setLoading(false);
      showErrorMessage(t('MESSAGES:checkNetConnection'));
    }
  };
  const CheckConnectivity = (data) => {
    if (Platform.OS === 'android') {
      NetInfo.fetch().then((state) => {
        if (state.isConnected) {
          _createPatientAccount(data);
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

  return (
    <SafeAreaView style={Styles.safeArea_Conatiner}>
      <View style={Styles.view_Container}>
        <ImageBackground
          source={Images.background}
          style={Styles.img_Background}
          resizeMode="stretch">
          <CustomHeader
            TitleTxt={t('SIGNUP_SCREEN:signUp')}
            LeftComponent={() => {
              return (
                <Button transparent onPress={() => navigation.goBack()}>
                  <Icon
                    name="ios-arrow-back"
                    type="Ionicons"
                    style={Styles.icon_BackArrow}
                  />
                </Button>
              );
            }}
          />
          <Spinner visible={loading} color={Colors.colorBlack} />
          <KeyboardAwareScrollView
            enableOnAndroid={true}
            keyboardShouldPersistTaps={'handled'}
            extraScrollHeight={70}>
            <View style={styles.view_FormContainer}>
              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('HOMEVISIT_SCREEN:patientName')}
                    keyboardType="default"
                    returnKeyType={'next'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'person'}
                    iconType={'MaterialIcons'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="name"
                rules={{required: true}}
                defaultValue={accountData.name}
              />

              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('HOMEVISIT_SCREEN:phoneNumber')}
                    keyboardType="phone-pad"
                    returnKeyType={'next'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'call'}
                    iconType={'MaterialIcons'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="phone"
                rules={{required: true}}
                defaultValue={accountData.phone}
              />

              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('FORGETCODE_SCREEN:email')}
                    keyboardType="email-address"
                    returnKeyType={'done'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'mail'}
                    iconType={'Entypo'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="email"
                rules={{required: true, pattern: {value: EMAIL_REGEX}}}
                defaultValue={accountData.email}
              />

              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('HOMEVISIT_SCREEN:address')}
                    keyboardType="default"
                    returnKeyType={'next'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'location-on'}
                    iconType={'MaterialIcons'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="address"
                rules={{required: true}}
                defaultValue={accountData.address}
              />

              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabDatePicker
                    placeholderTxt={t('HOMEVISIT_SCREEN:dateOfBirth')}
                    dateValue={value}
                    maxDate={new Date()}
                    onDateChange={(value) => onChange(value)}
                    confirmTxt={t('GENERAL:ok')}
                    cancalTxt={t('GENERAL:cancal')}
                  />
                )}
                name="dob"
                rules={{required: true}}
                defaultValue={accountData.dob}
              />

              <RadioForm
                style={{
                  marginVertical: 10,
                  marginLeft: 40,
                }}
                formHorizontal={true}
                labelStyle={{paddingRight: 30}}
                radio_props={radio_props}
                initial={accountData.gender}
                onPress={(NewPatientGender) => {
                  setAccountData({...accountData, gender: NewPatientGender});
                }}
              />
              <ExtremeLabButton
                ButtonText={t('SIGNIN_SCREEN:createAnAccount')}
                onPress={handleSubmit(CheckConnectivity)}
              />
            </View>
          </KeyboardAwareScrollView>
        </ImageBackground>
      </View>
    </SafeAreaView>
  );
};
export default SignUpScreen;
const styles = StyleSheet.create({
  view_FormContainer: {flex: 1, alignItems: 'center', marginVertical: 30},
  view_LoginForm: {
    flex: 1,
    alignItems: 'center',
    marginTop: 120,
  },
  item_PatientCode: {
    width: wp('90%'),
    height: hp('9%'),
    borderRadius: 10,
    marginTop: 20,
    backgroundColor: Colors.colorWhite,
    paddingHorizontal: 10,
    marginVertical: 10,
  },
  btn_ForgetCode: {marginVertical: 10},
  txt_ForgetCode: {
    fontSize: Fonts.size.regular,
    color: Colors.colorRed,
  },
});
