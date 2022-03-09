/* eslint-disable @typescript-eslint/no-var-requires */
/*   
    Merges locales files and csv with translations to a new csv file
    Use this script to get missing translations
    beer++
*/
const csv = require('csvtojson')
const fs = require('fs')
const Excel = require('exceljs');



//file path from root of project
const csvFilePath = './translation-helpers/JSON_Translations.csv'
const xlsxOutputFilePath = `./translation-helpers/JSON_Translations.xlsx`;

// if you're lazy and use file path with spaces
// csvFilePath = csvFilePath.replace(/(\s+)/g, '\\$1');

/**
 *   change as needed
 *   key = used to create the locale folder ex: ./public/locales/{key}/common.json
 *   value = the csv column header for each lang 
 */
const localesMap = {
  ro: 'Romana',
  en: 'Engleza',
  uk: 'Ucrainieana',
  ru: 'Rusa',
}

// the csv column header used for translation keys
const identifier = 'Identifier'

// folder path for the translations
const localesFolderPath = './resources/lang'
const getLangJsonArray = async () => {

  try {
    if (fs.existsSync(csvFilePath)) {
      const langJsonArray = await csv().fromFile(csvFilePath);
      return langJsonArray;
    }
  } catch(err) {
    console.warn('csv file not found');
  }

  return [];
}

const generateJsonTranslationsCsv = async () => {
  const langJsonArray = await getLangJsonArray();
  const resultAcc = {};
  const allKeys = []

  for (const [key, value] of Object.entries(localesMap)) {
    const langJson = JSON.parse(fs.readFileSync(`${localesFolderPath}/${key}.json`, 'utf8'));

    const languagesMapped = langJsonArray.reduce(
      (acc, cur) => ({ ...acc, [cur[identifier]]: cur[value] }),
      {},
    )

    // add file translations so we won't loose them
    // If both objects have a property with the same name, then the second object property overwrites the first
    var data = { ...langJson, ...languagesMapped }
    allKeys.push(...Object.keys(data));

    resultAcc[value] = data;
  }
  const distinctKeys = new Set(allKeys)

  var rowsData = [];
  // add header row 
  rowsData.push([identifier, ...Object.values(localesMap)]);

  distinctKeys.forEach(key => {
    const rowData = [key];
    for (const [_, value] of Object.entries(localesMap)) {
      rowData.push(resultAcc[value][key] ?? '')
    }
    rowsData.push(rowData);
  });

  const wb = new Excel.Workbook();
  const ws = wb.addWorksheet('JSON_Translations');

  ws.addRows(rowsData);

  wb.xlsx
    .writeFile(xlsxOutputFilePath)
    .then(() => {
      console.log('file created! Enjoy; beer++');
    })
    .catch(err => {
      console.error(err.message);
    });
}

generateJsonTranslationsCsv()
