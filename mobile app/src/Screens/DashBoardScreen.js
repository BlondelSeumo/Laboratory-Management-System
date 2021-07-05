import React, {useEffect, useContext, useState} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  Text,
  ScrollView,
  StatusBar,
  TouchableOpacity,
  I18nManager,
} from 'react-native';
import LinearGradient from 'react-native-linear-gradient';
import Spinner from 'react-native-spinkit';
import {useIsFocused} from '@react-navigation/native';
import {SinglePickerMaterialDialog} from 'react-native-material-dialog';
import {useTranslation} from 'react-i18next';
import RNRestart from 'react-native-restart';

import {Colors, Styles, Fonts, Languages} from '../constants';
import {ExtremeLabResultCard} from '../components';
import {Context as TestResultsContext} from '../context/testResultsContext';
import {Context as UserContext} from '../context/userContext';
import {getLanaguageType, setLanaguageType} from '../StorageManager';

const DashBoardScreen = ({navigation}) => {
  const [singlePickerVisible, setSinglePickerVisible] = useState(false);
  const {state, getDashboardData} = useContext(TestResultsContext);
  const UserConsumer = useContext(UserContext);
  const [loading, setLoading] = useState(true);
  const [selectedLanguage, setSelectedLanguage] = useState(
    UserConsumer.state.userLanguage,
  );

  const isFocused = useIsFocused();
  const {t, i18n} = useTranslation();

  useEffect(() => {
    (async () => {
      setSelectedLanguage(await getLanaguageType());
      await getDashboardData();
      setLoading(false);
    })();
  }, [isFocused]);

  const _changeLanguage = async (result) => {
    await setLanaguageType(result.selectedItem);
    await UserConsumer.setLangaugeContext(result.selectedItem);
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
    <SafeAreaView style={Styles.view_Container}>
      <StatusBar backgroundColor="#011F6A" />
      <View style={Styles.view_Container}>
        {loading ? (
          <View style={Styles.view_Spinner}>
            <Spinner type={'ThreeBounce'} color={Colors.colorAzureRadiance} />
          </View>
        ) : (
          <LinearGradient
            style={{flex: 1}}
            useAngle={true}
            angle={90}
            angleCenter={{x: 0.5, y: 0.5}}
            colors={['#011F6A', '#002A9E']}>
            {!!selectedLanguage && (
              <TouchableOpacity
                onPress={() => setSinglePickerVisible(true)}
                style={styles.btn_SelectLanguage}>
                <Text
                  style={{
                    color: Colors.colorBlack,
                    fontSize: Fonts.size.regular,
                  }}>
                  {selectedLanguage.label}
                </Text>
              </TouchableOpacity>
            )}
            <SinglePickerMaterialDialog
              title={t('DASHBOARD_SCREEN:selectYourLanguage')}
              items={Languages}
              visible={singlePickerVisible}
              selectedItem={selectedLanguage}
              onCancel={() => setSinglePickerVisible(false)}
              onOk={async (result) => _changeLanguage(result)}
              cancelLabel={t('GENERAL:cancel')}
              okLabel={t('GENERAL:ok')}
              scrolled={true}
            />
            <Text
              style={{
                color: '#FFF',
                alignSelf: 'center',
                marginTop: 40,
                fontSize: Fonts.size.regular,
              }}>
              {`${t('DASHBOARD_SCREEN:welocme')}, ${
                UserConsumer.state.userData.name
              }`}
            </Text>
            <View style={styles.view_ResultContainer}>
              <View style={styles.view_ResultTextContainer}>
                <Text style={styles.txt_Results}>
                  {t('TESTS_SCREEN:results')}
                </Text>
              </View>
              <ScrollView style={{marginTop: 70}}>
                <ExtremeLabResultCard
                  ResultName={t('DASHBOARD_SCREEN:totalTests')}
                  ResultNumber={state.dashboardData.groups}
                  onPress={() => {
                    navigation.navigate('TestsScreen');
                  }}
                  IconName="list"
                />
                <ExtremeLabResultCard
                  ResultName={t('DASHBOARD_SCREEN:completedTests')}
                  ResultNumber={state.dashboardData.completed_groups}
                  onPress={() => {
                    navigation.navigate('TestsScreen');
                  }}
                  IconName="check"
                />
                <ExtremeLabResultCard
                  ResultName={t('DASHBOARD_SCREEN:pendingTests')}
                  ResultNumber={state.dashboardData.pending_groups}
                  onPress={() => {
                    navigation.navigate('TestsScreen');
                  }}
                  IconName="pause"
                />
              </ScrollView>
            </View>
          </LinearGradient>
        )}
      </View>
    </SafeAreaView>
  );
};

export default DashBoardScreen;

const styles = StyleSheet.create({
  view_ResultTextContainer: {
    borderRadius: 50,
    backgroundColor: Colors.colorWhite,
    width: 100,
    height: 100,
    zIndex: 1,
    position: 'absolute',
    top: -50,
    alignSelf: 'center',
    justifyContent: 'center',
    alignItems: 'center',
  },
  txt_Results: {
    fontSize: Fonts.size.regular,
    color: Colors.colorMidnightBlue,
    flexWrap: 'wrap',
  },
  view_ResultContainer: {
    flex: 1,
    alignItems: 'center',
    marginTop: 70,
    backgroundColor: Colors.colorWhisper,
    borderTopLeftRadius: 20,
    borderTopRightRadius: 20,
  },
  btn_SelectLanguage: {
    position: 'absolute',
    top: 15,
    right: 15,
    backgroundColor: Colors.colorWhite,
    width: 30,
    height: 30,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
  },
});
