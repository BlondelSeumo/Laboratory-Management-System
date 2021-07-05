import React, {useState, useEffect, useContext} from 'react';
import {
  View,
  StyleSheet,
  SafeAreaView,
  FlatList,
  Text,
  TouchableOpacity,
  Image,
} from 'react-native';
import Spinner from 'react-native-spinkit';
import {Colors, Styles, Images, Fonts} from '../../constants';
import {CustomHeader, NoDataFound} from '../../components';
import {Picker, Icon, Item} from 'native-base';
import {
  widthPercentageToDP as wp,
  heightPercentageToDP as hp,
} from 'react-native-responsive-screen';
import {useUpdateEffect} from './../../Utils/useUpdateEffect';
import {Context as TestResultsContext} from '../../context/testResultsContext';
import {useTranslation} from 'react-i18next';
const TestsScreen = ({navigation}) => {
  const [loading, setLoading] = useState(true);
  const [pickerSelectedValue, setPickerSelectedValue] = useState(0);
  const [testsData, setTestsData] = useState([]);
  const {state, getGroupTestsData} = useContext(TestResultsContext);
  const {t} = useTranslation();
  useEffect(() => {
    (async () => {
      await getGroupTestsData();
    })();
  }, []);
  useUpdateEffect(() => {
    setTestsData(state.allTestResults);
    setLoading(false);
  }, [state.allTestResults]);

  useUpdateEffect(() => {
    setLoading(true);
    let newFilterdTests = [];
    if (pickerSelectedValue === 0) {
      setTestsData(state.allTestResults);
    } else if (pickerSelectedValue === 1) {
      newFilterdTests = state.allTestResults.filter((test) => test.done === 1);
      setTestsData(newFilterdTests);
    } else {
      newFilterdTests = state.allTestResults.filter((test) => test.done === 0);
      setTestsData(newFilterdTests);
    }
    setLoading(false);
  }, [pickerSelectedValue]);

  const renderItem = ({item}) => {
    return (
      <View style={styles.view_TestContainer}>
        <Text style={styles.txt_TestProp}>{`${t('TESTS_SCREEN:createdAt')} : ${
          item.created_at
        }`}</Text>
        <Text style={styles.txt_TestProp}>{`${t('TESTS_SCREEN:paid')} : ${
          item.paid
        }`}</Text>
        <Text style={styles.txt_TestProp}>{`${t('TESTS_SCREEN:due')} : ${
          item.due
        }`}</Text>
        <Text style={styles.txt_TestProp}>{`${t('TESTS_SCREEN:status')} : ${
          item.done === 1 ? t('TESTS_SCREEN:done') : t('TESTS_SCREEN:pending')
        }`}</Text>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'space-between',
            marginVertical: 5,
          }}>
          <TouchableOpacity
            onPress={() =>
              navigation.navigate('ResultsPdfScreen', {
                ResultsURL: item.receipt_pdf,
              })
            }
            style={{flexDirection: 'row', justifyContent: 'flex-start'}}>
            <Text style={[styles.txt_TestProp, {color: Colors.colorRed}]}>
              {t('TESTS_SCREEN:viewReceipt')}
            </Text>
            <Image
              source={Images.PDF}
              style={{
                resizeMode: 'contain',
                width: wp('5%'),
                height: hp('3%'),
                marginHorizontal: 5,
              }}
            />
          </TouchableOpacity>

          {!!item.done && (
            <TouchableOpacity
              onPress={() =>
                navigation.navigate('ResultsPdfScreen', {
                  ResultsURL: item.report_pdf,
                })
              }
              style={{flexDirection: 'row', justifyContent: 'flex-end'}}>
              <Text style={[styles.txt_TestProp, {color: Colors.colorRed}]}>
                {t('TESTS_SCREEN:viewResults')}
              </Text>
              <Image
                source={Images.PDF}
                style={{
                  resizeMode: 'contain',
                  width: wp('5%'),
                  height: hp('3%'),
                  marginHorizontal: 5,
                }}
              />
            </TouchableOpacity>
          )}
        </View>
      </View>
    );
  };

  return (
    <SafeAreaView style={Styles.safeArea_Conatiner}>
      <View style={Styles.view_Container}>
        <CustomHeader TitleTxt={t('TESTS_SCREEN:results')} />
        {loading ? (
          <View style={styles.view_Spinner}>
            <Spinner type={'ThreeBounce'} color={Colors.colorAzureRadiance} />
          </View>
        ) : (
          <View style={styles.view_ResultBody}>
            <Item
              style={{
                width: wp('90%'),
                backgroundColor: Colors.colorWhite,
                borderRadius: 10,
              }}>
              <Picker
                iosIcon={<Icon name="arrow-down" />}
                textStyle={{color: '#5cb85c'}}
                itemStyle={{
                  backgroundColor: '#d3d3d3',
                  marginLeft: 0,
                  paddingLeft: 10,
                }}
                itemTextStyle={{color: '#788ad2'}}
                selectedValue={pickerSelectedValue}
                onValueChange={(value) => setPickerSelectedValue(value)}>
                <Picker.Item
                  label={t('DASHBOARD_SCREEN:totalTests')}
                  value={0}
                />
                <Picker.Item
                  label={t('DASHBOARD_SCREEN:completedTests')}
                  value={1}
                />
                <Picker.Item
                  label={t('DASHBOARD_SCREEN:pendingTests')}
                  value={2}
                />
              </Picker>
            </Item>
            {testsData.length === 0 ? (
              <NoDataFound label={t('TESTS_SCREEN:tests').toLowerCase()} />
            ) : (
              <FlatList
                style={styles.flatList_Tests}
                data={testsData}
                showsVerticalScrollIndicator={false}
                keyExtractor={(item) => item.id.toString()}
                renderItem={(item) => renderItem(item)}
              />
            )}
          </View>
        )}
      </View>
    </SafeAreaView>
  );
};
export default TestsScreen;
const styles = StyleSheet.create({
  view_Spinner: {flex: 1, justifyContent: 'center', alignItems: 'center'},
  result_txt: {
    alignSelf: 'center',
    marginVertical: 10,
    fontSize: Fonts.size.h5,
    color: Colors.colorGullGray,
  },
  view_ResultBody: {
    marginVertical: 10,
    flex: 1,
    alignItems: 'center',
  },
  view_TestContainer: {
    width: wp('90%'),
    backgroundColor: Colors.colorWhite,
    borderColor: Colors.colorWhite,
    borderRadius: 5,
    borderWidth: 2,
    padding: 10,
    marginBottom: 10,
  },
  flatList_Tests: {
    marginVertical: 10,
  },
  txt_TestProp: {
    fontSize: Fonts.size.medium,
    color: Colors.colorGrey,
  },
});
