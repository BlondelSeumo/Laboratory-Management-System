import React from 'react';
import {View, StyleSheet, SafeAreaView, I18nManager} from 'react-native';
import Pdf from 'react-native-pdf';
import {Icon, Button} from 'native-base';
import {Colors, Styles} from '../../constants';
import {CustomHeader} from '../../components';
import {useTranslation} from 'react-i18next';
import Share from 'react-native-share';
import {ConvertPdfToBase64} from '../../Utils/helperFunctions';

const ResultsPdfScreen = ({route, navigation}) => {
  const {t} = useTranslation();
  const _shareResults = async () => {
    const url = route.params.ResultsURL.replace(/ /g, '%20');
    let shareOptions = {
      message: 'Results',
    };
    await ConvertPdfToBase64(url).then((res) => {
      shareOptions.url = 'data:application/pdf;base64,' + res;
    });
    try {
      await Share.open(shareOptions);
    } catch (error) {
      console.log('error', error);
    }
  };

  return (
    <SafeAreaView style={Styles.safeArea_Conatiner}>
      <View style={Styles.view_Container}>
        <CustomHeader
          TitleTxt={t('TESTS_SCREEN:reports')}
          LeftComponent={() => {
            return (
              <Button transparent onPress={() => navigation.goBack()}>
                <Icon
                  name="ios-arrow-back"
                  type="Ionicons"
                  style={styles.icon_BackArrow}
                />
              </Button>
            );
          }}
          RightComponent={() => {
            return (
              <Button
                transparent
                onPress={() =>
                  _shareResults(route.params.ResultsURL.replace(/ /g, '%20'))
                }>
                <Icon
                  name="forward"
                  type="Entypo"
                  style={[
                    styles.icon_BackArrow,
                    {transform: [{rotate: '0deg'}]},
                  ]}
                />
              </Button>
            );
          }}
        />
        <Pdf
          source={{
            uri: route.params.ResultsURL.replace(/ /g, '%20'),
          }}
          style={styles.view_ResultPDFBody}
        />
      </View>
    </SafeAreaView>
  );
};
export default ResultsPdfScreen;
const styles = StyleSheet.create({
  view_ResultPDFBody: {
    flex: 1,
  },
  icon_BackArrow: {
    color: Colors.colorWhite,
    fontSize: 25,
    transform: [{rotate: I18nManager.isRTL ? '180deg' : '0deg'}],
  },
});
