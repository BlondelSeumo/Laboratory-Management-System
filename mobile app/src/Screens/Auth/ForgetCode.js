import React, {useState, useContext, useEffect} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  Image,
  ImageBackground,
  Platform,
  ActivityIndicator,
  I18nManager,
  Keyboard,
} from 'react-native';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import NetInfo from '@react-native-community/netinfo';
import {KeyboardAwareScrollView} from '@codler/react-native-keyboard-aware-scroll-view';
import {Icon, Button} from 'native-base';
import {Styles, Colors, Images, VALIDATIONTYPES} from '../../constants';
import {
  ExtremeLabButton,
  CustomHeader,
  ExtremeLabTextInput,
} from '../../components';
import {Context as UserContext} from '../../context/userContext';
import {encodingURLParams} from './../../Utils/helperFunctions';
import {
  getAPIError,
  showErrorMessage,
  showSuccessMessage,
} from '../../Utils/FlashMsgs';
import {useTranslation} from 'react-i18next';
import {useForm, Controller} from 'react-hook-form';
import {EMAIL_REGEX} from '../../Utils/ConstantValues';

const ForgetCode = ({navigation}) => {
  const [patientMail, setPatientMail] = useState('');
  const [loading, setLoading] = useState(false);
  const {forgetCode} = useContext(UserContext);
  const {t} = useTranslation();
  const {control, handleSubmit, errors} = useForm();
  useEffect(() => {
    if (errors.patientMail?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:emailIsRequired'));
    } else if (errors.patientMail?.type === VALIDATIONTYPES.pattern) {
      showErrorMessage(t('MESSAGES:emailIsNotValid'));
    }
    Keyboard.dismiss();
  }, [errors]);

  const submitPatientEmail = async (data) => {
    Keyboard.dismiss();

    setLoading(true);
    let body = {
      email: data.patientMail,
    };
    let formBody = encodingURLParams(body);
    await forgetCode(formBody, async (response, error) => {
      if (!error) {
        showSuccessMessage(t('MESSAGES:checkMail'));
        navigation.navigate('SignInScreen');
      } else {
        if (!!error.message) {
          showErrorMessage(error.message);
        } else {
          showErrorMessage(getAPIError(error));
        }
      }
      setLoading(false);
    });
  };
  const handleFirstConnectivityChange = (state) => {
    NetInfo.removeEventListener(
      'connectionChange',
      this.handleFirstConnectivityChange,
    );
    if (state.isConnected) {
      submitPatientEmail;
    } else {
      setLoading(false);
      showErrorMessage(t('MESSAGES:checkNetConnection'));
    }
  };
  const CheckConnectivity = (data) => {
    if (Platform.OS === 'android') {
      NetInfo.fetch().then((state) => {
        if (state.isConnected) {
          submitPatientEmail(data);
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
    <SafeAreaView style={Styles.view_Container}>
      <ImageBackground
        source={Images.background}
        style={Styles.img_Background}
        resizeMode="stretch">
        <CustomHeader
          TitleTxt={t('FORGETCODE_SCREEN:forgetCode')}
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
        <KeyboardAwareScrollView
          contentContainerStyle={{
            flexGrow: 1,
            justifyContent: 'center',
            alignItems: 'center',
          }}
          enableOnAndroid={true}
          extraScrollHeight={10}
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
              name="patientMail"
              rules={{required: true, pattern: {value: EMAIL_REGEX}}}
              defaultValue={patientMail}
            />
            <ExtremeLabButton
              ButtonText={t('FORGETCODE_SCREEN:forgetCode')}
              onPress={handleSubmit(CheckConnectivity)}
            />
            <ActivityIndicator
              animating={loading}
              size="large"
              color={Colors.colorAzureRadiance}
            />
          </View>
        </KeyboardAwareScrollView>
      </ImageBackground>
    </SafeAreaView>
  );
};
export default ForgetCode;
const styles = StyleSheet.create({
  img_Logo: {
    width: wp('50%'),
    height: hp('15%'),
    marginBottom: 40,
  },
  view_LoginForm: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  item_PatientMail: {
    width: wp('90%'),
    height: hp('9%'),
    borderRadius: 10,
    marginTop: 20,
    backgroundColor: Colors.colorWhite,
    paddingHorizontal: 10,
    marginVertical: 10,
  },
});
