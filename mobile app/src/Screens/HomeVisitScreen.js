import React, {useState, useContext, useEffect, useRef} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  Text,
  Image,
  TouchableOpacity,
  I18nManager,
} from 'react-native';
import {KeyboardAwareScrollView} from '@codler/react-native-keyboard-aware-scroll-view';
import {Styles, Colors, Fonts, VALIDATIONTYPES} from '../constants';
import {
  CustomHeader,
  ExtremeLabButton,
  ExtremeLabDatePicker,
  ExtremeLabTextInput,
} from '../components';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import {Icon} from 'native-base';
import moment from 'moment';
import RadioForm from 'react-native-simple-radio-button';
import ImagePicker from 'react-native-image-picker';
import Spinner from 'react-native-loading-spinner-overlay';
import {radio_props, radio_Userprops} from '../Utils/ConstantValues';
import {
  checkImagePickerPermissions,
  encodingURLParams,
  getGender,
  requestLocationPermission,
} from '../Utils/helperFunctions';
import {Context as UserContext} from '../context/userContext';
import Geolocation from '@react-native-community/geolocation';
import {useIsFocused} from '@react-navigation/native';
import {useTranslation} from 'react-i18next';
import {useForm, Controller} from 'react-hook-form';
import NetInfo from '@react-native-community/netinfo';
import {showErrorMessage, showSuccessMessage} from '../Utils/FlashMsgs';

const HomeVisitScreen = ({navigation}) => {
  const [loading, setLoading] = useState(false);
  const {state, reserveHomeVisit} = useContext(UserContext);
  const {control, handleSubmit, errors, setValue} = useForm();
  const [homeVisitData, setHomeVisitData] = useState({
    name: '',
    phone: '',
    address: '',
    lat: null,
    lng: null,
    corporation: '',
    visitDate: '',
    dob: '',
    gender: 0,
    userType: 0,
    testImagePath: {},
  });
  //To forceUpdate
  const [, updateState] = React.useState();
  const forceUpdate = React.useCallback(() => updateState({}), []);
  const refRdo = useRef(null);
  const isFocused = useIsFocused();
  const {t} = useTranslation();
  const translateRadioProp = () => {
    radio_props.map((item) => {
      if (item.value === 0) {
        item.label = t('HOMEVISIT_SCREEN:male');
      } else {
        item.label = t('HOMEVISIT_SCREEN:female');
      }
    });
    radio_Userprops.map((item) => {
      if (item.value === 0) {
        item.label = t('HOMEVISIT_SCREEN:currentUser');
      } else {
        item.label = t('HOMEVISIT_SCREEN:newUser');
      }
    });
  };
  useEffect(() => {
    translateRadioProp();
    (async () => {
      let permissionGranted = await requestLocationPermission();
      if (permissionGranted) {
        Geolocation.getCurrentPosition(
          (position) => {
            setHomeVisitData({
              ...homeVisitData,
              lng: JSON.stringify(position.coords.longitude),
            });
            setHomeVisitData({
              ...homeVisitData,
              lat: JSON.stringify(position.coords.latitude),
            });
          },
          (error) => alert(error.message),
          {
            enableHighAccuracy: false,
            timeout: 20000,
          },
        );
      }
    })();

    return () => {
      clearState();
    };
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
    } else if (errors.visitDate?.type === VALIDATIONTYPES.required) {
      showErrorMessage(t('MESSAGES:visitDateIsRequired'));
    }
  }, [errors]);

  const clearState = () => {
    refRdo.current.updateIsActiveIndex(0);
    setHomeVisitData({
      name: '',
      phone: '',
      address: '',
      lat: null,
      lng: null,
      corporation: '',
      visitDate: '',
      dob: '',
      gender: 0,
      userType: 0,
      testImagePath: {},
    });
    setValue('name', homeVisitData.name);
    setValue('phone', homeVisitData.phone);
    setValue('address', homeVisitData.address);
    setValue('corporation', homeVisitData.corporation);
    setValue('dob', homeVisitData.dob);
    setValue('visitDate', homeVisitData.visitDate);
  };

  const _chooseFile = () => {
    checkImagePickerPermissions();
    var options = {
      title: t('HOMEVISIT_SCREEN:selectPrescriptionImage'),
      cancelButtonTitle: t('GENERAL:cancel'),
      takePhotoButtonTitle: t('HOMEVISIT_SCREEN:takePhotoButtonTitle'),
      chooseFromLibraryButtonTitle: t(
        'HOMEVISIT_SCREEN:chooseFromLibraryButtonTitle',
      ),
      mediaType: 'photo',
      storageOptions: {
        skipBackup: true,
        path: 'images',
      },
      maxWidth: 500,
      maxHeight: 500,
      quality: 0.5,
    };
    ImagePicker.showImagePicker(options, (response) => {
      if (response.didCancel) {
      } else if (response.error) {
      } else {
        let source = response;
        setHomeVisitData({...homeVisitData, testImagePath: source});
      }
    });
  };

  // helper
  const getHomeVisitDataBasedOnUserType = (data) => {
    if (homeVisitData.userType === 0) {
      return {
        patient_id: state.userData.id,
        visit_date: data.visitDate,
        attach: 'data:image/jpeg;base64,' + homeVisitData.testImagePath.data,
      };
    } else {
      return {
        name: data.name,
        phone: data.phone,
        address: data.address,
        lat: homeVisitData.lat,
        lng: homeVisitData.lng,
        corporation: data.corporation,
        gender: getGender(homeVisitData.gender),
        dob: data.dob,
        visit_date: data.visitDate,
        attach: 'data:image/jpeg;base64,' + homeVisitData.testImagePath.data,
        email: state.userData.email,
      };
    }
  };

  const _submitHomVisitData = async (data) => {
    if (Object.keys(homeVisitData.testImagePath).length === 0) {
      showErrorMessage(t('MESSAGES:PrescriptionImageIsRequired'));
      return;
    }
    let params = getHomeVisitDataBasedOnUserType(data);
    setLoading(true);
    let bodyForm = encodingURLParams(params);
    await reserveHomeVisit(bodyForm, (response, error) => {
      if (!error) {
        showSuccessMessage(t('MESSAGES:homeVisitIsReservedSuccessfully'));
        clearState();
        forceUpdate();
        // navigation.navigate('DashBoardScreen');
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
          _submitHomVisitData(data);
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
        <CustomHeader TitleTxt={t('HOMEVISIT_SCREEN:homeVisit')} />
        <Text style={styles.txt_note} numberOfLines={2}>
          {t('HOMEVISIT_SCREEN:reservationMessage')}
        </Text>
        <Spinner visible={loading} color={Colors.colorBlack} />
        <KeyboardAwareScrollView
          extraScrollHeight={70}
          contentContainerStyle={{
            flexGrow: 1,
            justifyContent: 'center',
            alignItems: 'center',
          }}
          keyboardShouldPersistTaps={'handled'}>
          <View style={styles.view_HomeVisitForm}>
            <RadioForm
              style={{
                marginVertical: 10,
              }}
              ref={refRdo}
              radioStyle={{paddingRight: 20}}
              buttonSize={15}
              buttonOuterSize={25}
              formHorizontal={true}
              labelStyle={{marginHorizontal: 15}}
              buttonWrapStyle={{margin: 50}}
              radio_props={radio_Userprops}
              initial={homeVisitData.userType}
              onPress={(value) => {
                setHomeVisitData({...homeVisitData, userType: value});
              }}
            />
            {!!homeVisitData.userType && (
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
                defaultValue={homeVisitData.name}
              />
            )}

            {!!homeVisitData.userType && (
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
                defaultValue={homeVisitData.phone}
              />
            )}

            {!!homeVisitData.userType && (
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
                defaultValue={homeVisitData.address}
              />
            )}

            {!!homeVisitData.userType && (
              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabTextInput
                    placeholderTxt={t('HOMEVISIT_SCREEN:corporation')}
                    keyboardType="default"
                    returnKeyType={'next'}
                    value={value}
                    onChangeText={(value) => onChange(value)}
                    iconName={'building'}
                    iconType={'FontAwesome'}
                    rtl={I18nManager.isRTL}
                  />
                )}
                name="corporation"
                defaultValue={homeVisitData.corporation}
              />
            )}
            {!!homeVisitData.userType && (
              <Controller
                control={control}
                render={({onChange, value}) => (
                  <ExtremeLabDatePicker
                    placeholderTxt={t('HOMEVISIT_SCREEN:dateOfBirth')}
                    dateValue={value}
                    onDateChange={(value) => onChange(value)}
                    confirmTxt={t('GENERAL:ok')}
                    cancalTxt={t('GENERAL:cancal')}
                  />
                )}
                name="dob"
                rules={{required: true}}
                defaultValue={homeVisitData.dob}
              />
            )}

            {!!homeVisitData.userType && (
              <RadioForm
                style={{
                  marginVertical: 10,
                }}
                radioStyle={{paddingRight: 20}}
                buttonSize={15}
                buttonOuterSize={25}
                formHorizontal={true}
                labelStyle={{marginHorizontal: 15}}
                buttonWrapStyle={{margin: 50}}
                radio_props={radio_props}
                initial={homeVisitData.gender}
                onPress={(value) => {
                  setHomeVisitData({...homeVisitData, gender: value});
                }}
              />
            )}

            <Controller
              control={control}
              render={({onChange, value}) => (
                <ExtremeLabDatePicker
                  iconName={'clinic-medical'}
                  iconType={'FontAwesome5'}
                  placeholderTxt={t('HOMEVISIT_SCREEN:visitDate')}
                  dateValue={value}
                  minDate={new Date()}
                  maxDate={moment(
                    new Date().setFullYear(new Date().getFullYear() + 1),
                  ).format('YYYY-MM-DD')}
                  onDateChange={(value) => onChange(value)}
                  confirmTxt={t('GENERAL:ok')}
                  cancalTxt={t('GENERAL:cancal')}
                />
              )}
              name="visitDate"
              rules={{required: true}}
              defaultValue={homeVisitData.visitDate}
            />

            <TouchableOpacity
              style={{
                marginVertical: 10,
                alignItems: 'center',
              }}
              onPress={() => _chooseFile()}>
              {homeVisitData.testImagePath.data ? (
                <Image
                  style={{
                    width: wp('37.5%'),
                    height: hp('25%'),
                    borderRadius: 20,
                  }}
                  source={{
                    uri:
                      'data:image/jpeg;base64,' +
                      homeVisitData.testImagePath.data,
                  }}
                />
              ) : (
                <View style={styles.view_ImageContainer}>
                  <Icon
                    name="camera"
                    type="FontAwesome"
                    style={{marginTop: 15}}
                  />
                  <Text style={styles.txt_CapturePrescription}>
                    {t('HOMEVISIT_SCREEN:uploadPrescription')}
                  </Text>
                </View>
              )}
            </TouchableOpacity>

            <ExtremeLabButton
              ButtonText={t('HOMEVISIT_SCREEN:reserveNow')}
              onPress={handleSubmit(CheckConnectivity)}
            />
          </View>
        </KeyboardAwareScrollView>
      </View>
    </SafeAreaView>
  );
};

export default HomeVisitScreen;
const styles = StyleSheet.create({
  txt_note: {
    paddingVertical: 15,
    paddingHorizontal: 20,
    fontSize: Fonts.size.medium,
    color: '#d50000',
    alignSelf: 'center',
    lineHeight: 17,
  },
  view_HomeVisitForm: {flex: 1, alignItems: 'center'},
  txt_CapturePrescription: {
    color: Colors.colorBlack,
    textAlign: 'center',
    marginTop: 10,
  },
  view_ImageContainer: {
    padding: 25,
    alignItems: 'center',
    width: wp('37.5%'),
    height: hp('22%'),
    backgroundColor: Colors.colorWhite,
    borderRadius: 20,
  },
});
