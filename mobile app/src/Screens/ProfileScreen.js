import React, {useState, useContext, useEffect} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  TouchableOpacity,
  I18nManager,
  Keyboard,
} from 'react-native';
import {KeyboardAwareScrollView} from '@codler/react-native-keyboard-aware-scroll-view';
import RadioForm from 'react-native-simple-radio-button';
import Spinner from 'react-native-loading-spinner-overlay';
import {useTranslation} from 'react-i18next';
import {useIsFocused} from '@react-navigation/native';
import AsyncStorage from '@react-native-community/async-storage';
import {Controller, useForm} from 'react-hook-form';
import NetInfo from '@react-native-community/netinfo';
import {Icon} from 'native-base';
import {
  CustomHeader,
  ExtremeLabButton,
  ExtremeLabTextInput,
  ExtremeLabDatePicker,
} from '../components';
import {Styles, Colors, VALIDATIONTYPES, Languages} from '../constants';
import {
  getAPIError,
  showErrorMessage,
  showSuccessMessage,
} from '../Utils/FlashMsgs';
import {Context as UserContext} from '../context/userContext';
import {radio_props} from '../Utils/ConstantValues';
import {getGender, encodingURLParams} from '../Utils/helperFunctions';

import moment from 'moment';
import {setLanaguageType} from '../StorageManager';
const ProfileScreen = () => {
  const {
    state,
    updatePatientDate,
    setUserDataContext,
    signout,
    setLangaugeContext,
  } = useContext(UserContext);
  const [profileData, setProfileData] = useState({
    ...state.userData,
    gender:
      state.userData.gender.toLowerCase().trim() === 'Male'.toLowerCase().trim()
        ? 0
        : 1,
  });
  const [loading, setLoading] = useState(false);
  const {t} = useTranslation();
  const {control, handleSubmit, errors, setValue} = useForm();

  const translateRadioProp = () => {
    radio_props.map((item) => {
      if (item.value === 0) {
        item.label = t('HOMEVISIT_SCREEN:male');
      } else {
        item.label = t('HOMEVISIT_SCREEN:female');
      }
    });
  };
  const isFocused = useIsFocused();

  useEffect(() => {
    setValue('name', profileData.name);
    setValue('phone', profileData.phone);
    setValue('address', profileData.address);
    setValue('dob', profileData.dob);
    translateRadioProp();
    Keyboard.dismiss();
  }, [isFocused]);

  useEffect(() => {
    if (errors.name?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:nameIsRequired'));
    } else if (errors.phone?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:phoneIsRequired'));
    } else if (errors.address?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:addressIsRequired'));
    } else if (errors.dob?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:dobIsRequired'));
    }
  }, [errors]);

  const _updateProfileData = async (data) => {
    Keyboard.dismiss();
    setLoading(true);
    // console.warn(data.dob, ':: ', moment(data.dob).format('DD-MM-YYYY'));
    //TODO: Send only the required fields
    let bodyForm = encodingURLParams({
      ...profileData,
      name: data.name,
      phone: data.phone,
      address: data.address,
      dob:
        data.dob !== profileData.dob
          ? moment(data.dob).format('DD-MM-YYYY')
          : data.dob,
      gender: getGender(profileData.gender),
    });
    await updatePatientDate(bodyForm, async (response, error) => {
      if (!error) {
        showSuccessMessage(t('MESSAGES:updateProfileDataSuccessfully'));
        await setUserDataContext(response.data.body.patient);
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
          _updateProfileData(data);
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
        <CustomHeader
          TitleTxt={t('PROFILE_SCREEN:profile')}
          RightComponent={() => {
            return (
              <TouchableOpacity
                style={styles.btn_Logout}
                onPress={async () => {
                  await AsyncStorage.clear();
                  await setLanaguageType(Languages[1]);
                  await setLangaugeContext(Languages[1]);
                  signout();
                }}>
                <Icon
                  name="logout-variant"
                  type="MaterialCommunityIcons"
                  style={{color: Colors.colorWhite, fontSize: 20}}
                />
              </TouchableOpacity>
            );
          }}
        />
        <Spinner visible={loading} color={Colors.colorBlack} />
        <KeyboardAwareScrollView
          extraScrollHeight={70}
          keyboardShouldPersistTaps={'handled'}>
          <View style={styles.view_ProfileContainer}>
            <Controller
              control={control}
              render={({onChange, value}) => (
                <ExtremeLabTextInput
                  placeholderTxt={t('PROFILE_SCREEN:patientName')}
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
              defaultValue={profileData.name}
            />

            <Controller
              control={control}
              render={({onChange, value}) => (
                <ExtremeLabTextInput
                  placeholderTxt={t('PROFILE_SCREEN:phoneNumber')}
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
              defaultValue={profileData.phone}
            />

            <Controller
              control={control}
              render={({onChange, value}) => (
                <ExtremeLabTextInput
                  placeholderTxt={t('PROFILE_SCREEN:address')}
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
              defaultValue={profileData.address}
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
              defaultValue={profileData.dob}
            />

            <RadioForm
              style={{
                marginVertical: 10,
              }}
              buttonSize={15}
              buttonOuterSize={25}
              formHorizontal={true}
              labelStyle={{marginHorizontal: 15}}
              buttonWrapStyle={{margin: 50}}
              radio_props={radio_props}
              initial={profileData.gender}
              onPress={(NewPatientGender) => {
                setProfileData({...profileData, gender: NewPatientGender});
              }}
            />
            <ExtremeLabButton
              ButtonText={t('PROFILE_SCREEN:updateProfileInfo')}
              onPress={handleSubmit(CheckConnectivity)}
            />
          </View>
        </KeyboardAwareScrollView>
      </View>
    </SafeAreaView>
  );
};

export default ProfileScreen;
const styles = StyleSheet.create({
  view_ProfileContainer: {
    flex: 1,
    alignItems: 'center',
    backgroundColor: Colors.colorWhisper,
    borderTopLeftRadius: 20,
    borderTopRightRadius: 20,
    paddingVertical: 50,
  },
  btn_Logout: {
    backgroundColor: '#FF6666',
    width: 30,
    height: 30,
    borderRadius: 5,
    alignItems: 'center',
    justifyContent: 'center',
  },
});
