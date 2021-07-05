import React, {useEffect, useContext, useState} from 'react';
import {
  View,
  Text,
  StyleSheet,
  SafeAreaView,
  Platform,
  Linking,
  FlatList,
  I18nManager,
} from 'react-native';
import {Context as UserContext} from '../context/userContext';
import Spinner from 'react-native-spinkit';
import {Colors, Styles, Fonts} from '../constants';
import {CustomHeader, NoDataFound} from '../components';
import {Icon, Button} from 'native-base';
import {widthPercentageToDP as wp} from 'react-native-responsive-screen';
import {useTranslation} from 'react-i18next';
import {getAPIError, showErrorMessage} from '../Utils/FlashMsgs';
const BranchesScreen = () => {
  const {state, getAllLabBranches, setBranchesContext} = useContext(
    UserContext,
  );
  const [loading, setLoading] = useState(true);
  const {t} = useTranslation();

  useEffect(() => {
    (async () => {
      await getAllLabBranches((response, error) => {
        if (!error) {
          setBranchesContext(response);
        } else {
          if (!!error.message) {
            showErrorMessage(error.message);
          } else {
            showErrorMessage(getAPIError(error));
          }
        }
      });
      setLoading(false);
    })();
  }, []);
  const callNumber = (phone) => {
    let phoneNumber = phone;
    if (Platform.OS !== 'android') {
      phoneNumber = `telprompt:${phone}`;
    } else {
      phoneNumber = `tel:${phone}`;
    }
    Linking.canOpenURL(phoneNumber)
      .then((supported) => {
        if (!supported) {
          showErrorMessage(t('BRANCHES_SCREEN:phoneNumberNotAvaliable'));
        } else {
          return Linking.openURL(phoneNumber);
        }
      })
      .catch((err) => console.warn(err));
  };
  const showMap = (item) => {
    const scheme = Platform.select({
      ios: 'maps:0,0?q=',
      android: 'geo:0,0?q=',
    });
    const latLng = `${item.lat},${item.lng}`;
    const label = item.address;
    const url = Platform.select({
      ios: `${scheme}${label}@${latLng}`,
      android: `${scheme}${latLng}(${label})`,
    });
    Linking.openURL(url);
  };
  const renderBranche = ({item}) => {
    return (
      <View style={styles.view_BranchContainer}>
        <Text style={styles.txt_BranchName}>{item.name}</Text>
        <View
          style={styles.view_BranchDataRow}
          onPress={() => callNumber(item.phone)}>
          <Icon
            name="phone-alt"
            type="FontAwesome5"
            style={styles.icon_Phone}
          />
          <Text style={styles.txt_BranchPhoneAddress}>{item.phone}</Text>
        </View>
        <View style={styles.view_BranchDataRow}>
          <Icon
            name={'location-on'}
            type={'MaterialIcons'}
            style={styles.icon_Map}
          />
          <Text style={styles.txt_BranchPhoneAddress}>{item.address}</Text>
        </View>
        <View style={styles.view_CallMapcontainer}>
          <Button
            info
            style={styles.button_CallMap}
            onPress={() => callNumber(item.phone)}>
            <Text style={styles.txt_button}>
              {t('BRANCHES_SCREEN:callNow')}
            </Text>
          </Button>
          <Button
            dark
            style={styles.button_CallMap}
            onPress={() => showMap(item)}>
            <Text style={styles.txt_button}>
              {t('BRANCHES_SCREEN:showMap')}
            </Text>
          </Button>
        </View>
      </View>
    );
  };
  return (
    <SafeAreaView style={Styles.safeArea_Conatiner}>
      <View style={Styles.view_Container}>
        <CustomHeader TitleTxt={t('BRANCHES_SCREEN:branches')} />
        {loading ? (
          <View style={styles.view_Spinner}>
            <Spinner type={'ThreeBounce'} color={Colors.colorAzureRadiance} />
          </View>
        ) : (
          <View style={styles.flatList_Branches}>
            {state.branches === null ? (
              <NoDataFound
                label={t('BRANCHES_SCREEN:branches').toLowerCase()}
              />
            ) : (
              <FlatList
                data={state.branches}
                showsVerticalScrollIndicator={false}
                keyExtractor={(item) => {
                  return item.id.toString();
                }}
                renderItem={(item) => renderBranche(item)}
              />
            )}
          </View>
        )}
      </View>
    </SafeAreaView>
  );
};
export default BranchesScreen;
const styles = StyleSheet.create({
  view_Spinner: {flex: 1, justifyContent: 'center', alignItems: 'center'},
  flatList_Branches: {flex: 1, alignItems: 'center', marginVertical: 20},
  view_BranchContainer: {
    width: wp('90%'),
    backgroundColor: Colors.colorWhite,
    borderColor: Colors.colorWhite,
    borderRadius: 15,
    borderWidth: 2,
    paddingVertical: 10,
    marginBottom: 15,
  },
  txt_BranchName: {
    fontSize: Fonts.size.regular,
    fontWeight: 'bold',
    paddingLeft: 5,
    alignSelf: 'center',
  },
  view_BranchDataRow: {
    flexDirection: 'row',
    marginHorizontal: 10,
    paddingVertical: 2.5,
  },
  txt_BranchPhoneAddress: {fontSize: Fonts.size.medium, paddingHorizontal: 10},
  view_CallMapcontainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 5,
    marginHorizontal: 20,
  },
  button_CallMap: {
    alignSelf: 'center',
    padding: 10,
    height: 35,
    borderRadius: 8,
  },
  btn_CallNow: {
    alignSelf: 'center',
    padding: 10,
    height: 35,
    borderRadius: 8,
  },
  txt_button: {
    color: Colors.colorWhite,
  },
  icon_Map: {
    fontSize: 22,
  },
  icon_Phone: {
    fontSize: 18,
    transform: [{rotate: I18nManager.isRTL ? '260deg' : '0deg'}],
  },
});
