<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id(); 
            $table->char('iso',2)->nullable()->comment(''); 
            $table->string('name')->nullable()->comment(''); 
            $table->string('nicename')->nullable()->comment('');
            $table->char('iso3', 3)->nullable()->comment('');
            $table->string('numcode')->nullable()->comment('');
            $table->string('phonecode')->nullable()->comment('');
            $table->timestamps();
        });
        \App\Models\countries::insert([
            [ 'iso' =>  'AF', 'name' =>  'AFGHANISTAN', 'nicename' => 'Afghanistan', 'iso3' =>4, 'numcode' => 'AFG', 'phonecode' => 93],
            [ 'iso' =>  'AL', 'name' =>  'ALBANIA', 'nicename' => 'Albania', 'iso3' =>8, 'numcode' => 'ALB', 'phonecode' => 355],
            [ 'iso' =>  'DZ', 'name' =>  'ALGERIA', 'nicename' => 'Algeria', 'iso3' =>12, 'numcode' => 'DZA', 'phonecode' => 213],
            [ 'iso' =>  'AS', 'name' =>  'AMERICAN SAMOA', 'nicename' => 'American Samoa', 'iso3' =>16, 'numcode' => 'ASM', 'phonecode' => 1684],
            [ 'iso' =>  'AD', 'name' =>  'ANDORRA', 'nicename' => 'Andorra', 'iso3' =>20, 'numcode' => 'AND', 'phonecode' => 376],
            [ 'iso' =>  'AO', 'name' =>  'ANGOLA', 'nicename' => 'Angola', 'iso3' =>24, 'numcode' => 'AGO', 'phonecode' => 244],
            [ 'iso' =>  'AI', 'name' =>  'ANGUILLA', 'nicename' => 'Anguilla', 'iso3' =>660, 'numcode' => 'AIA', 'phonecode' => 1264],
            [ 'iso' =>  'AQ', 'name' =>  'ANTARCTICA', 'nicename' => 'Antarctica', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 0],
            [ 'iso' =>  'AG', 'name' =>  'ANTIGUA AND BARBUDA', 'nicename' => 'Antigua and Barbuda', 'iso3' =>28, 'numcode' => 'ATG', 'phonecode' => 1268],
            [ 'iso' =>  'AR', 'name' =>  'ARGENTINA', 'nicename' => 'Argentina', 'iso3' =>32, 'numcode' => 'ARG', 'phonecode' => 54],
            [ 'iso' =>  'AM', 'name' =>  'ARMENIA', 'nicename' => 'Armenia', 'iso3' =>51, 'numcode' => 'ARM', 'phonecode' => 374],
            [ 'iso' =>  'AW', 'name' =>  'ARUBA', 'nicename' => 'Aruba', 'iso3' =>533, 'numcode' => 'ABW', 'phonecode' => 297],
            [ 'iso' =>  'AU', 'name' =>  'AUSTRALIA', 'nicename' => 'Australia', 'iso3' =>36, 'numcode' => 'AUS', 'phonecode' => 61],
            [ 'iso' =>  'AT', 'name' =>  'AUSTRIA', 'nicename' => 'Austria', 'iso3' =>40, 'numcode' => 'AUT', 'phonecode' => 43],
            [ 'iso' =>  'AZ', 'name' =>  'AZERBAIJAN', 'nicename' => 'Azerbaijan', 'iso3' =>31, 'numcode' => 'AZE', 'phonecode' => 994],
            [ 'iso' =>  'BS', 'name' =>  'BAHAMAS', 'nicename' => 'Bahamas', 'iso3' =>44, 'numcode' => 'BHS', 'phonecode' => 1242],
            [ 'iso' =>  'BH', 'name' =>  'BAHRAIN', 'nicename' => 'Bahrain', 'iso3' =>48, 'numcode' => 'BHR', 'phonecode' => 973],
            [ 'iso' =>  'BD', 'name' =>  'BANGLADESH', 'nicename' => 'Bangladesh', 'iso3' =>50, 'numcode' => 'BGD', 'phonecode' => 880],
            [ 'iso' =>  'BB', 'name' =>  'BARBADOS', 'nicename' => 'Barbados', 'iso3' =>52, 'numcode' => 'BRB', 'phonecode' => 1246],
            [ 'iso' =>  'BY', 'name' =>  'BELARUS', 'nicename' => 'Belarus', 'iso3' =>112, 'numcode' => 'BLR', 'phonecode' => 375],
            [ 'iso' =>  'BE', 'name' =>  'BELGIUM', 'nicename' => 'Belgium', 'iso3' =>56, 'numcode' => 'BEL', 'phonecode' => 32],
            [ 'iso' =>  'BZ', 'name' =>  'BELIZE', 'nicename' => 'Belize', 'iso3' =>84, 'numcode' => 'BLZ', 'phonecode' => 501],
            [ 'iso' =>  'BJ', 'name' =>  'BENIN', 'nicename' => 'Benin', 'iso3' =>204, 'numcode' => 'BEN', 'phonecode' => 229],
            [ 'iso' =>  'BM', 'name' =>  'BERMUDA', 'nicename' => 'Bermuda', 'iso3' =>60, 'numcode' => 'BMU', 'phonecode' => 1441],
            [ 'iso' =>  'BT', 'name' =>  'BHUTAN', 'nicename' => 'Bhutan', 'iso3' =>64, 'numcode' => 'BTN', 'phonecode' => 975],
            [ 'iso' =>  'BO', 'name' =>  'BOLIVIA', 'nicename' => 'Bolivia', 'iso3' =>68, 'numcode' => 'BOL', 'phonecode' => 591],
            [ 'iso' =>  'BA', 'name' =>  'BOSNIA AND HERZEGOVINA', 'nicename' => 'Bosnia and Herzegovina', 'iso3' =>70, 'numcode' => 'BIH', 'phonecode' => 387],
            [ 'iso' =>  'BW', 'name' =>  'BOTSWANA', 'nicename' => 'Botswana', 'iso3' =>72, 'numcode' => 'BWA', 'phonecode' => 267],
            [ 'iso' =>  'BV', 'name' =>  'BOUVET ISLAND', 'nicename' => 'Bouvet Island', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 0],
            [ 'iso' =>  'BR', 'name' =>  'BRAZIL', 'nicename' => 'Brazil', 'iso3' =>76, 'numcode' => 'BRA', 'phonecode' => 55],
            [ 'iso' =>  'IO', 'name' =>  'BRITISH INDIAN OCEAN TERRITORY', 'nicename' => 'British Indian Ocean Territory', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 246],
            [ 'iso' =>  'BN', 'name' =>  'BRUNEI DARUSSALAM', 'nicename' => 'Brunei Darussalam', 'iso3' =>96, 'numcode' => 'BRN', 'phonecode' => 673],
            [ 'iso' =>  'BG', 'name' =>  'BULGARIA', 'nicename' => 'Bulgaria', 'iso3' =>100, 'numcode' => 'BGR', 'phonecode' => 359],
            [ 'iso' =>  'BF', 'name' =>  'BURKINA FASO', 'nicename' => 'Burkina Faso', 'iso3' =>854, 'numcode' => 'BFA', 'phonecode' => 226],
            [ 'iso' =>  'BI', 'name' =>  'BURUNDI', 'nicename' => 'Burundi', 'iso3' =>108, 'numcode' => 'BDI', 'phonecode' => 257],
            [ 'iso' =>  'KH', 'name' =>  'CAMBODIA', 'nicename' => 'Cambodia', 'iso3' =>116, 'numcode' => 'KHM', 'phonecode' => 855],
            [ 'iso' =>  'CM', 'name' =>  'CAMEROON', 'nicename' => 'Cameroon', 'iso3' =>120, 'numcode' => 'CMR', 'phonecode' => 237],
            [ 'iso' =>  'CA', 'name' =>  'CANADA', 'nicename' => 'Canada', 'iso3' =>124, 'numcode' => 'CAN', 'phonecode' => 1],
            [ 'iso' =>  'CV', 'name' =>  'CAPE VERDE', 'nicename' => 'Cape Verde', 'iso3' =>132, 'numcode' => 'CPV', 'phonecode' => 238],
            [ 'iso' =>  'KY', 'name' =>  'CAYMAN ISLANDS', 'nicename' => 'Cayman Islands', 'iso3' =>136, 'numcode' => 'CYM', 'phonecode' => 1345],
            [ 'iso' =>  'CF', 'name' =>  'CENTRAL AFRICAN REPUBLIC', 'nicename' => 'Central African Republic', 'iso3' =>140, 'numcode' => 'CAF', 'phonecode' => 236],
            [ 'iso' =>  'TD', 'name' =>  'CHAD', 'nicename' => 'Chad', 'iso3' =>148, 'numcode' => 'TCD', 'phonecode' => 235],
            [ 'iso' =>  'CL', 'name' =>  'CHILE', 'nicename' => 'Chile', 'iso3' =>152, 'numcode' => 'CHL', 'phonecode' => 56],
            [ 'iso' =>  'CN', 'name' =>  'CHINA', 'nicename' => 'China', 'iso3' =>156, 'numcode' => 'CHN', 'phonecode' => 86],
            [ 'iso' =>  'CX', 'name' =>  'CHRISTMAS ISLAND', 'nicename' => 'Christmas Island', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 61],
            [ 'iso' =>  'CC', 'name' =>  'COCOS [KEELING ISLANDS', 'nicename' => 'Cocos [Keeling Islands', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 672],
            [ 'iso' =>  'CO', 'name' =>  'COLOMBIA', 'nicename' => 'Colombia', 'iso3' =>170, 'numcode' => 'COL', 'phonecode' => 57],
            [ 'iso' =>  'KM', 'name' =>  'COMOROS', 'nicename' => 'Comoros', 'iso3' =>174, 'numcode' => 'COM', 'phonecode' => 269],
            [ 'iso' =>  'CG', 'name' =>  'CONGO', 'nicename' => 'Congo', 'iso3' =>178, 'numcode' => 'COG', 'phonecode' => 242],
            [ 'iso' =>  'CD', 'name' =>  'CONGO', 'nicename' => 'THE DEMOCRATIC REPUBLIC OF THE \'Congo the Democratic Republic of the', 'iso3' =>180, 'numcode' => 'COD', 'phonecode' => 242],
            [ 'iso' =>  'CK', 'name' =>  'COOK ISLANDS', 'nicename' => 'Cook Islands', 'iso3' =>184, 'numcode' => 'COK', 'phonecode' => 682],
            [ 'iso' =>  'CR', 'name' =>  'COSTA RICA', 'nicename' => 'Costa Rica', 'iso3' =>188, 'numcode' => 'CRI', 'phonecode' => 506],
            [ 'iso' =>  'CI', 'name' =>  'COTE D\'IVOIRE', 'nicename' => 'Cote D\'Ivoire', 'iso3' =>384, 'numcode' => 'CIV', 'phonecode' => 225],
            [ 'iso' =>  'HR', 'name' =>  'CROATIA', 'nicename' => 'Croatia', 'iso3' =>191, 'numcode' => 'HRV', 'phonecode' => 385],
            [ 'iso' =>  'CU', 'name' =>  'CUBA', 'nicename' => 'Cuba', 'iso3' =>192, 'numcode' => 'CUB', 'phonecode' => 53],
            [ 'iso' =>  'CY', 'name' =>  'CYPRUS', 'nicename' => 'Cyprus', 'iso3' =>196, 'numcode' => 'CYP', 'phonecode' => 357],
            [ 'iso' =>  'CZ', 'name' =>  'CZECH REPUBLIC', 'nicename' => 'Czech Republic', 'iso3' =>203, 'numcode' => 'CZE', 'phonecode' => 420],
            [ 'iso' =>  'DK', 'name' =>  'DENMARK', 'nicename' => 'Denmark', 'iso3' =>208, 'numcode' => 'DNK', 'phonecode' => 45],
            [ 'iso' =>  'DJ', 'name' =>  'DJIBOUTI', 'nicename' => 'Djibouti', 'iso3' =>262, 'numcode' => 'DJI', 'phonecode' => 253],
            [ 'iso' =>  'DM', 'name' =>  'DOMINICA', 'nicename' => 'Dominica', 'iso3' =>212, 'numcode' => 'DMA', 'phonecode' => 1767],
            [ 'iso' =>  'DO', 'name' =>  'DOMINICAN REPUBLIC', 'nicename' => 'Dominican Republic', 'iso3' =>214, 'numcode' => 'DOM', 'phonecode' => 1809],
            [ 'iso' =>  'EC', 'name' =>  'ECUADOR', 'nicename' => 'Ecuador', 'iso3' =>218, 'numcode' => 'ECU', 'phonecode' => 593],
            [ 'iso' =>  'EG', 'name' =>  'EGYPT', 'nicename' => 'Egypt', 'iso3' =>818, 'numcode' => 'EGY', 'phonecode' => 20],
            [ 'iso' =>  'SV', 'name' =>  'EL SALVADOR', 'nicename' => 'El Salvador', 'iso3' =>222, 'numcode' => 'SLV', 'phonecode' => 503],
            [ 'iso' =>  'GQ', 'name' =>  'EQUATORIAL GUINEA', 'nicename' => 'Equatorial Guinea', 'iso3' =>226, 'numcode' => 'GNQ', 'phonecode' => 240],
            [ 'iso' =>  'ER', 'name' =>  'ERITREA', 'nicename' => 'Eritrea', 'iso3' =>232, 'numcode' => 'ERI', 'phonecode' => 291],
            [ 'iso' =>  'EE', 'name' =>  'ESTONIA', 'nicename' => 'Estonia', 'iso3' =>233, 'numcode' => 'EST', 'phonecode' => 372],
            [ 'iso' =>  'ET', 'name' =>  'ETHIOPIA', 'nicename' => 'Ethiopia', 'iso3' =>231, 'numcode' => 'ETH', 'phonecode' => 251],
            [ 'iso' =>  'FK', 'name' =>  'FALKLAND ISLANDS [MALVINAS', 'nicename' => 'Falkland Islands [Malvinas', 'iso3' =>238, 'numcode' => 'FLK', 'phonecode' => 500],
            [ 'iso' =>  'FO', 'name' =>  'FAROE ISLANDS', 'nicename' => 'Faroe Islands', 'iso3' =>234, 'numcode' => 'FRO', 'phonecode' => 298],
            [ 'iso' =>  'FJ', 'name' =>  'FIJI', 'nicename' => 'Fiji', 'iso3' =>242, 'numcode' => 'FJI', 'phonecode' => 679],
            [ 'iso' =>  'FI', 'name' =>  'FINLAND', 'nicename' => 'Finland', 'iso3' =>246, 'numcode' => 'FIN', 'phonecode' => 358],
            [ 'iso' =>  'FR', 'name' =>  'FRANCE', 'nicename' => 'France', 'iso3' =>250, 'numcode' => 'FRA', 'phonecode' => 33],
            [ 'iso' =>  'GF', 'name' =>  'FRENCH GUIANA', 'nicename' => 'French Guiana', 'iso3' =>254, 'numcode' => 'GUF', 'phonecode' => 594],
            [ 'iso' =>  'PF', 'name' =>  'FRENCH POLYNESIA', 'nicename' => 'French Polynesia', 'iso3' =>258, 'numcode' => 'PYF', 'phonecode' => 689],
            [ 'iso' =>  'TF', 'name' =>  'FRENCH SOUTHERN TERRITORIES', 'nicename' => 'French Southern Territories', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 0],
            [ 'iso' =>  'GA', 'name' =>  'GABON', 'nicename' => 'Gabon', 'iso3' =>266, 'numcode' => 'GAB', 'phonecode' => 241],
            [ 'iso' =>  'GM', 'name' =>  'GAMBIA', 'nicename' => 'Gambia', 'iso3' =>270, 'numcode' => 'GMB', 'phonecode' => 220],
            [ 'iso' =>  'GE', 'name' =>  'GEORGIA', 'nicename' => 'Georgia', 'iso3' =>268, 'numcode' => 'GEO', 'phonecode' => 995],
            [ 'iso' =>  'DE', 'name' =>  'GERMANY', 'nicename' => 'Germany', 'iso3' =>276, 'numcode' => 'DEU', 'phonecode' => 49],
            [ 'iso' =>  'GH', 'name' =>  'GHANA', 'nicename' => 'Ghana', 'iso3' =>288, 'numcode' => 'GHA', 'phonecode' => 233],
            [ 'iso' =>  'GI', 'name' =>  'GIBRALTAR', 'nicename' => 'Gibraltar', 'iso3' =>292, 'numcode' => 'GIB', 'phonecode' => 350],
            [ 'iso' =>  'GR', 'name' =>  'GREECE', 'nicename' => 'Greece', 'iso3' =>300, 'numcode' => 'GRC', 'phonecode' => 30],
            [ 'iso' =>  'GL', 'name' =>  'GREENLAND', 'nicename' => 'Greenland', 'iso3' =>304, 'numcode' => 'GRL', 'phonecode' => 299],
            [ 'iso' =>  'GD', 'name' =>  'GRENADA', 'nicename' => 'Grenada', 'iso3' =>308, 'numcode' => 'GRD', 'phonecode' => 1473],
            [ 'iso' =>  'GP', 'name' =>  'GUADELOUPE', 'nicename' => 'Guadeloupe', 'iso3' =>312, 'numcode' => 'GLP', 'phonecode' => 590],
            [ 'iso' =>  'GU', 'name' =>  'GUAM', 'nicename' => 'Guam', 'iso3' =>316, 'numcode' => 'GUM', 'phonecode' => 1671],
            [ 'iso' =>  'GT', 'name' =>  'GUATEMALA', 'nicename' => 'Guatemala', 'iso3' =>320, 'numcode' => 'GTM', 'phonecode' => 502],
            [ 'iso' =>  'GN', 'name' =>  'GUINEA', 'nicename' => 'Guinea', 'iso3' =>324, 'numcode' => 'GIN', 'phonecode' => 224],
            [ 'iso' =>  'GW', 'name' =>  'GUINEA-BISSAU', 'nicename' => 'Guinea-Bissau', 'iso3' =>624, 'numcode' => 'GNB', 'phonecode' => 245],
            [ 'iso' =>  'GY', 'name' =>  'GUYANA', 'nicename' => 'Guyana', 'iso3' =>328, 'numcode' => 'GUY', 'phonecode' => 592],
            [ 'iso' =>  'HT', 'name' =>  'HAITI', 'nicename' => 'Haiti', 'iso3' =>332, 'numcode' => 'HTI', 'phonecode' => 509],
            [ 'iso' =>  'HM', 'name' =>  'HEARD ISLAND AND MCDONALD ISLANDS', 'nicename' => 'Heard Island and Mcdonald Islands', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 0],
            [ 'iso' =>  'VA', 'name' =>  'HOLY SEE VATICAN CITY STATE', 'nicename' => 'Holy See Vatican City State', 'iso3' =>336, 'numcode' => 'VAT', 'phonecode' => 39],
            [ 'iso' =>  'HN', 'name' =>  'HONDURAS', 'nicename' => 'Honduras', 'iso3' =>340, 'numcode' => 'HND', 'phonecode' => 504],
            [ 'iso' =>  'HK', 'name' =>  'HONG KONG', 'nicename' => 'Hong Kong', 'iso3' =>344, 'numcode' => 'HKG', 'phonecode' => 852],
            [ 'iso' =>  'HU', 'name' =>  'HUNGARY', 'nicename' => 'Hungary', 'iso3' =>348, 'numcode' => 'HUN', 'phonecode' => 36],
            [ 'iso' =>  'IS', 'name' =>  'ICELAND', 'nicename' => 'Iceland', 'iso3' =>352, 'numcode' => 'ISL', 'phonecode' => 354],
            [ 'iso' =>  'IN', 'name' =>  'INDIA', 'nicename' => 'India', 'iso3' =>356, 'numcode' => 'IND', 'phonecode' => 91],
            [ 'iso' =>  'ID', 'name' =>  'INDONESIA', 'nicename' => 'Indonesia', 'iso3' =>360, 'numcode' => 'IDN', 'phonecode' => 62],
            [ 'iso' =>  'IR', 'name' =>  'IRAN', 'nicename' => 'ISLAMIC REPUBLIC OF\'  Islamic Republic of Iran', 'iso3' =>364, 'numcode' => 'IRN', 'phonecode' => 98],
            [ 'iso' =>  'IQ', 'name' =>  'IRAQ', 'nicename' => 'Iraq', 'iso3' =>368, 'numcode' => 'IRQ', 'phonecode' => 964],
            [ 'iso' =>  'IE', 'name' =>  'IRELAND', 'nicename' => 'Ireland', 'iso3' =>372, 'numcode' => 'IRL', 'phonecode' => 353],
            [ 'iso' =>  'IL', 'name' =>  'ISRAEL', 'nicename' => 'Israel', 'iso3' =>376, 'numcode' => 'ISR', 'phonecode' => 972],
            [ 'iso' =>  'IT', 'name' =>  'ITALY', 'nicename' => 'Italy', 'iso3' =>380, 'numcode' => 'ITA', 'phonecode' => 39],
            [ 'iso' =>  'JM', 'name' =>  'JAMAICA', 'nicename' => 'Jamaica', 'iso3' =>388, 'numcode' => 'JAM', 'phonecode' => 1876],
            [ 'iso' =>  'JP', 'name' =>  'JAPAN', 'nicename' => 'Japan', 'iso3' =>392, 'numcode' => 'JPN', 'phonecode' => 81],
            [ 'iso' =>  'JO', 'name' =>  'JORDAN', 'nicename' => 'Jordan', 'iso3' =>400, 'numcode' => 'JOR', 'phonecode' => 962],
            [ 'iso' =>  'KZ', 'name' =>  'KAZAKHSTAN', 'nicename' => 'Kazakhstan', 'iso3' =>398, 'numcode' => 'KAZ', 'phonecode' => 7],
            [ 'iso' =>  'KE', 'name' =>  'KENYA', 'nicename' => 'Kenya', 'iso3' =>404, 'numcode' => 'KEN', 'phonecode' => 254],
            [ 'iso' =>  'KI', 'name' =>  'KIRIBATI', 'nicename' => 'Kiribati', 'iso3' =>296, 'numcode' => 'KIR', 'phonecode' => 686],
            [ 'iso' =>  'KP', 'name' =>  'KOREA', 'nicename' =>'Democratic Peoples Republic of  Korea', 'iso3' =>408, 'numcode' => 'PRK', 'phonecode' => 850],
            [ 'iso' =>  'KR', 'name' =>  'KOREA', 'nicename' => 'Republic of Korea', 'iso3' =>410, 'numcode' =>'KOR', 'phonecode' => 82],
            [ 'iso' =>  'KW', 'name' =>  'KUWAIT', 'nicename' => 'Kuwait', 'iso3' =>414, 'numcode' => 'KWT', 'phonecode' => 965],
            [ 'iso' =>  'KG', 'name' =>  'KYRGYZSTAN', 'nicename' => 'Kyrgyzstan', 'iso3' =>417, 'numcode' => 'KGZ', 'phonecode' => 996],
            [ 'iso' =>  'LA', 'name' =>  'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'nicename' => 'Lao People\'s Democratic Republic', 'iso3' =>418, 'numcode' => 'LAO', 'phonecode' => 856],
            [ 'iso' =>  'LV', 'name' =>  'LATVIA', 'nicename' => 'Latvia', 'iso3' =>428, 'numcode' => 'LVA', 'phonecode' => 371],
            [ 'iso' =>  'LB', 'name' =>  'LEBANON', 'nicename' => 'Lebanon', 'iso3' =>422, 'numcode' => 'LBN', 'phonecode' => 961],
            [ 'iso' =>  'LS', 'name' =>  'LESOTHO', 'nicename' => 'Lesotho', 'iso3' =>426, 'numcode' => 'LSO', 'phonecode' => 266],
            [ 'iso' =>  'LR', 'name' =>  'LIBERIA', 'nicename' => 'Liberia', 'iso3' =>430, 'numcode' => 'LBR', 'phonecode' => 231],
            [ 'iso' =>  'LY', 'name' =>  'LIBYAN ARAB JAMAHIRIYA', 'nicename' => 'Libyan Arab Jamahiriya', 'iso3' =>434, 'numcode' => 'LBY', 'phonecode' => 218],
            [ 'iso' =>  'LI', 'name' =>  'LIECHTENSTEIN', 'nicename' => 'Liechtenstein', 'iso3' =>438, 'numcode' => 'LIE', 'phonecode' => 423],
            [ 'iso' =>  'LT', 'name' =>  'LITHUANIA', 'nicename' => 'Lithuania', 'iso3' =>440, 'numcode' => 'LTU', 'phonecode' => 370],
            [ 'iso' =>  'LU', 'name' =>  'LUXEMBOURG', 'nicename' => 'Luxembourg', 'iso3' =>442, 'numcode' => 'LUX', 'phonecode' => 352],
            [ 'iso' =>  'MO', 'name' =>  'MACAO', 'nicename' => 'Macao', 'iso3' =>446, 'numcode' => 'MAC', 'phonecode' => 853],
            [ 'iso' =>  'MK', 'name' =>  'MACEDONIA', 'nicename' =>'The Former Yugoslav Republic of Macedonia', 'iso3' =>807, 'numcode' => 'MKD', 'phonecode' => 389],
            [ 'iso' =>  'MG', 'name' =>  'MADAGASCAR', 'nicename' => 'Madagascar', 'iso3' =>450, 'numcode' => 'MDG', 'phonecode' => 261],
            [ 'iso' =>  'MW', 'name' =>  'MALAWI', 'nicename' => 'Malawi', 'iso3' =>454, 'numcode' => 'MWI', 'phonecode' => 265],
            [ 'iso' =>  'MY', 'name' =>  'MALAYSIA', 'nicename' => 'Malaysia', 'iso3' =>458, 'numcode' => 'MYS', 'phonecode' => 60],
            [ 'iso' =>  'MV', 'name' =>  'MALDIVES', 'nicename' => 'Maldives', 'iso3' =>462, 'numcode' => 'MDV', 'phonecode' => 960],
            [ 'iso' =>  'ML', 'name' =>  'MALI', 'nicename' => 'Mali', 'iso3' =>466, 'numcode' => 'MLI', 'phonecode' => 223],
            [ 'iso' =>  'MT', 'name' =>  'MALTA', 'nicename' => 'Malta', 'iso3' =>470, 'numcode' => 'MLT', 'phonecode' => 356],
            [ 'iso' =>  'MH', 'name' =>  'MARSHALL ISLANDS', 'nicename' => 'Marshall Islands', 'iso3' =>584, 'numcode' => 'MHL', 'phonecode' => 692],
            [ 'iso' =>  'MQ', 'name' =>  'MARTINIQUE', 'nicename' => 'Martinique', 'iso3' =>474, 'numcode' => 'MTQ', 'phonecode' => 596],
            [ 'iso' =>  'MR', 'name' =>  'MAURITANIA', 'nicename' => 'Mauritania', 'iso3' =>478, 'numcode' => 'MRT', 'phonecode' => 222],
            [ 'iso' =>  'MU', 'name' =>  'MAURITIUS', 'nicename' => 'Mauritius', 'iso3' =>480, 'numcode' => 'MUS', 'phonecode' => 230],
            [ 'iso' =>  'YT', 'name' =>  'MAYOTTE', 'nicename' => 'Mayotte', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 269],
            [ 'iso' =>  'MX', 'name' =>  'MEXICO', 'nicename' => 'Mexico', 'iso3' =>484, 'numcode' => 'MEX', 'phonecode' => 52],
            [ 'iso' =>  'FM', 'name' =>  'MICRONESIA', 'nicename' =>'Federated States of Micronesia', 'iso3' =>583, 'numcode' => 'FSM', 'phonecode' => 691],
            [ 'iso' =>  'MD', 'name' =>  'MOLDOVA', 'nicename' =>'Republic of Moldova', 'iso3' =>498, 'numcode' => 'MDA', 'phonecode' => 373],
            [ 'iso' =>  'MC', 'name' =>  'MONACO', 'nicename' => 'Monaco', 'iso3' =>492, 'numcode' => 'MCO', 'phonecode' => 377],
            [ 'iso' =>  'MN', 'name' =>  'MONGOLIA', 'nicename' => 'Mongolia', 'iso3' =>496, 'numcode' => 'MNG', 'phonecode' => 976],
            [ 'iso' =>  'MS', 'name' =>  'MONTSERRAT', 'nicename' => 'Montserrat', 'iso3' =>500, 'numcode' => 'MSR', 'phonecode' => 1664],
            [ 'iso' =>  'MA', 'name' =>  'MOROCCO', 'nicename' => 'Morocco', 'iso3' =>504, 'numcode' => 'MAR', 'phonecode' => 212],
            [ 'iso' =>  'MZ', 'name' =>  'MOZAMBIQUE', 'nicename' => 'Mozambique', 'iso3' =>508, 'numcode' => 'MOZ', 'phonecode' => 258],
            [ 'iso' =>  'MM', 'name' =>  'MYANMAR', 'nicename' => 'Myanmar', 'iso3' =>104, 'numcode' => 'MMR', 'phonecode' => 95],
            [ 'iso' =>  'NA', 'name' =>  'NAMIBIA', 'nicename' => 'Namibia', 'iso3' =>516, 'numcode' => 'NAM', 'phonecode' => 264],
            [ 'iso' =>  'NR', 'name' =>  'NAURU', 'nicename' => 'Nauru', 'iso3' =>520, 'numcode' => 'NRU', 'phonecode' => 674],
            [ 'iso' =>  'NP', 'name' =>  'NEPAL', 'nicename' => 'Nepal', 'iso3' =>524, 'numcode' => 'NPL', 'phonecode' => 977],
            [ 'iso' =>  'NL', 'name' =>  'NETHERLANDS', 'nicename' => 'Netherlands', 'iso3' =>528, 'numcode' => 'NLD', 'phonecode' => 31],
            [ 'iso' =>  'AN', 'name' =>  'NETHERLANDS ANTILLES', 'nicename' => 'Netherlands Antilles', 'iso3' =>530, 'numcode' => 'ANT', 'phonecode' => 599],
            [ 'iso' =>  'NC', 'name' =>  'NEW CALEDONIA', 'nicename' => 'New Caledonia', 'iso3' =>540, 'numcode' => 'NCL', 'phonecode' => 687],
            [ 'iso' =>  'NZ', 'name' =>  'NEW ZEALAND', 'nicename' => 'New Zealand', 'iso3' =>554, 'numcode' => 'NZL', 'phonecode' => 64],
            [ 'iso' =>  'NI', 'name' =>  'NICARAGUA', 'nicename' => 'Nicaragua', 'iso3' =>558, 'numcode' => 'NIC', 'phonecode' => 505],
            [ 'iso' =>  'NE', 'name' =>  'NIGER', 'nicename' => 'Niger', 'iso3' =>562, 'numcode' => 'NER', 'phonecode' => 227],
            [ 'iso' =>  'NG', 'name' =>  'NIGERIA', 'nicename' => 'Nigeria', 'iso3' =>566, 'numcode' => 'NGA', 'phonecode' => 234],
            [ 'iso' =>  'NU', 'name' =>  'NIUE', 'nicename' => 'Niue', 'iso3' =>570, 'numcode' => 'NIU', 'phonecode' => 683],
            [ 'iso' =>  'NF', 'name' =>  'NORFOLK ISLAND', 'nicename' => 'Norfolk Island', 'iso3' =>574, 'numcode' => 'NFK', 'phonecode' => 672],
            [ 'iso' =>  'MP', 'name' =>  'NORTHERN MARIANA ISLANDS', 'nicename' => 'Northern Mariana Islands', 'iso3' =>580, 'numcode' => 'MNP', 'phonecode' => 1670],
            [ 'iso' =>  'NO', 'name' =>  'NORWAY', 'nicename' => 'Norway', 'iso3' =>578, 'numcode' => 'NOR', 'phonecode' => 47],
            [ 'iso' =>  'OM', 'name' =>  'OMAN', 'nicename' => 'Oman', 'iso3' =>512, 'numcode' => 'OMN', 'phonecode' => 968],
            [ 'iso' =>  'PK', 'name' =>  'PAKISTAN', 'nicename' => 'Pakistan', 'iso3' =>586, 'numcode' => 'PAK', 'phonecode' => 92],
            [ 'iso' =>  'PW', 'name' =>  'PALAU', 'nicename' => 'Palau', 'iso3' =>585, 'numcode' => 'PLW', 'phonecode' => 680],
            [ 'iso' =>  'PS', 'name' =>  'PALESTINIAN TERRITORY', 'nicename' =>'Palestinian Territory Occupied', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 970],
            [ 'iso' =>  'PA', 'name' =>  'PANAMA', 'nicename' => 'Panama', 'iso3' =>591, 'numcode' => 'PAN', 'phonecode' => 507],
            [ 'iso' =>  'PG', 'name' =>  'PAPUA NEW GUINEA', 'nicename' => 'Papua New Guinea', 'iso3' =>598, 'numcode' => 'PNG', 'phonecode' => 675],
            [ 'iso' =>  'PY', 'name' =>  'PARAGUAY', 'nicename' => 'Paraguay', 'iso3' =>600, 'numcode' => 'PRY', 'phonecode' => 595],
            [ 'iso' =>  'PE', 'name' =>  'PERU', 'nicename' => 'Peru', 'iso3' =>604, 'numcode' => 'PER', 'phonecode' => 51],
            [ 'iso' =>  'PH', 'name' =>  'PHILIPPINES', 'nicename' => 'Philippines', 'iso3' =>608, 'numcode' => 'PHL', 'phonecode' => 63],
            [ 'iso' =>  'PN', 'name' =>  'PITCAIRN', 'nicename' => 'Pitcairn', 'iso3' =>612, 'numcode' => 'PCN', 'phonecode' => 0],
            [ 'iso' =>  'PL', 'name' =>  'POLAND', 'nicename' => 'Poland', 'iso3' =>616, 'numcode' => 'POL', 'phonecode' => 48],
            [ 'iso' =>  'PT', 'name' =>  'PORTUGAL', 'nicename' => 'Portugal', 'iso3' =>620, 'numcode' => 'PRT', 'phonecode' => 351],
            [ 'iso' =>  'PR', 'name' =>  'PUERTO RICO', 'nicename' => 'Puerto Rico', 'iso3' =>630, 'numcode' => 'PRI', 'phonecode' => 1787],
            [ 'iso' =>  'QA', 'name' =>  'QATAR', 'nicename' => 'Qatar', 'iso3' =>634, 'numcode' => 'QAT', 'phonecode' => 974],
            [ 'iso' =>  'RE', 'name' =>  'REUNION', 'nicename' => 'Reunion', 'iso3' =>638, 'numcode' => 'REU', 'phonecode' => 262],
            [ 'iso' =>  'RO', 'name' =>  'ROMANIA', 'nicename' => 'Romania', 'iso3' =>642, 'numcode' => 'ROM', 'phonecode' => 40],
            [ 'iso' =>  'RU', 'name' =>  'RUSSIAN FEDERATION', 'nicename' => 'Russian Federation', 'iso3' =>643, 'numcode' => 'RUS', 'phonecode' => 70],
            [ 'iso' =>  'RW', 'name' =>  'RWANDA', 'nicename' => 'Rwanda', 'iso3' =>646, 'numcode' => 'RWA', 'phonecode' => 250],
            [ 'iso' =>  'SH', 'name' =>  'SAINT HELENA', 'nicename' => 'Saint Helena', 'iso3' =>654, 'numcode' => 'SHN', 'phonecode' => 290],
            [ 'iso' =>  'KN', 'name' =>  'SAINT KITTS AND NEVIS', 'nicename' => 'Saint Kitts and Nevis', 'iso3' =>659, 'numcode' => 'KNA', 'phonecode' => 1869],
            [ 'iso' =>  'LC', 'name' =>  'SAINT LUCIA', 'nicename' => 'Saint Lucia', 'iso3' =>662, 'numcode' => 'LCA', 'phonecode' => 1758],
            [ 'iso' =>  'PM', 'name' =>  'SAINT PIERRE AND MIQUELON', 'nicename' => 'Saint Pierre and Miquelon', 'iso3' =>666, 'numcode' => 'SPM', 'phonecode' => 508],
            [ 'iso' =>  'VC', 'name' =>  'SAINT VINCENT AND THE GRENADINES', 'nicename' => 'Saint Vincent and the Grenadines', 'iso3' =>670, 'numcode' => 'VCT', 'phonecode' => 1784],
            [ 'iso' =>  'WS', 'name' =>  'SAMOA', 'nicename' => 'Samoa', 'iso3' =>882, 'numcode' => 'WSM', 'phonecode' => 684],
            [ 'iso' =>  'SM', 'name' =>  'SAN MARINO', 'nicename' => 'San Marino', 'iso3' =>674, 'numcode' => 'SMR', 'phonecode' => 378],
            [ 'iso' =>  'ST', 'name' =>  'SAO TOME AND PRINCIPE', 'nicename' => 'Sao Tome and Principe', 'iso3' =>678, 'numcode' => 'STP', 'phonecode' => 239],
            [ 'iso' =>  'SA', 'name' =>  'SAUDI ARABIA', 'nicename' => 'Saudi Arabia', 'iso3' =>682, 'numcode' => 'SAU', 'phonecode' => 966],
            [ 'iso' =>  'SN', 'name' =>  'SENEGAL', 'nicename' => 'Senegal', 'iso3' =>686, 'numcode' => 'SEN', 'phonecode' => 221],
            [ 'iso' =>  'CS', 'name' =>  'SERBIA AND MONTENEGRO', 'nicename' => 'Serbia and Montenegro', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 381],
            [ 'iso' =>  'SC', 'name' =>  'SEYCHELLES', 'nicename' => 'Seychelles', 'iso3' =>690, 'numcode' => 'SYC', 'phonecode' => 248],
            [ 'iso' =>  'SL', 'name' =>  'SIERRA LEONE', 'nicename' => 'Sierra Leone', 'iso3' =>694, 'numcode' => 'SLE', 'phonecode' => 232],
            [ 'iso' =>  'SG', 'name' =>  'SINGAPORE', 'nicename' => 'Singapore', 'iso3' =>702, 'numcode' => 'SGP', 'phonecode' => 65],
            [ 'iso' =>  'SK', 'name' =>  'SLOVAKIA', 'nicename' => 'Slovakia', 'iso3' =>703, 'numcode' => 'SVK', 'phonecode' => 421],
            [ 'iso' =>  'SI', 'name' =>  'SLOVENIA', 'nicename' => 'Slovenia', 'iso3' =>705, 'numcode' => 'SVN', 'phonecode' => 386],
            [ 'iso' =>  'SB', 'name' =>  'SOLOMON ISLANDS', 'nicename' => 'Solomon Islands', 'iso3' =>90, 'numcode' => 'SLB', 'phonecode' => 677],
            [ 'iso' =>  'SO', 'name' =>  'SOMALIA', 'nicename' => 'Somalia', 'iso3' =>706, 'numcode' => 'SOM', 'phonecode' => 252],
            [ 'iso' =>  'ZA', 'name' =>  'SOUTH AFRICA', 'nicename' => 'South Africa', 'iso3' =>710, 'numcode' => 'ZAF', 'phonecode' => 27],
            [ 'iso' =>  'GS', 'name' =>  'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'nicename' => 'South Georgia and the South Sandwich Islands', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 0],
            [ 'iso' =>  'ES', 'name' =>  'SPAIN', 'nicename' => 'Spain', 'iso3' =>724, 'numcode' => 'ESP', 'phonecode' => 34],
            [ 'iso' =>  'LK', 'name' =>  'SRI LANKA', 'nicename' => 'Sri Lanka', 'iso3' =>144, 'numcode' => 'LKA', 'phonecode' => 94],
            [ 'iso' =>  'SD', 'name' =>  'SUDAN', 'nicename' => 'Sudan', 'iso3' =>736, 'numcode' => 'SDN', 'phonecode' => 249],
            [ 'iso' =>  'SR', 'name' =>  'SURINAME', 'nicename' => 'Suriname', 'iso3' =>740, 'numcode' => 'SUR', 'phonecode' => 597],
            [ 'iso' =>  'SJ', 'name' =>  'SVALBARD AND JAN MAYEN', 'nicename' => 'Svalbard and Jan Mayen', 'iso3' =>744, 'numcode' => 'SJM', 'phonecode' => 47],
            [ 'iso' =>  'SZ', 'name' =>  'SWAZILAND', 'nicename' => 'Swaziland', 'iso3' =>748, 'numcode' => 'SWZ', 'phonecode' => 268],
            [ 'iso' =>  'SE', 'name' =>  'SWEDEN', 'nicename' => 'Sweden', 'iso3' =>752, 'numcode' => 'SWE', 'phonecode' => 46],
            [ 'iso' =>  'CH', 'name' =>  'SWITZERLAND', 'nicename' => 'Switzerland', 'iso3' =>756, 'numcode' => 'CHE', 'phonecode' => 41],
            [ 'iso' =>  'SY', 'name' =>  'SYRIAN ARAB REPUBLIC', 'nicename' => 'Syrian Arab Republic', 'iso3' =>760, 'numcode' => 'SYR', 'phonecode' => 963],
            [ 'iso' =>  'TW', 'name' =>  'TAIWAN', 'nicename' =>'Province of China', 'iso3' =>158, 'numcode' => 'TWN', 'phonecode' => 886],
            [ 'iso' =>  'TJ', 'name' =>  'TAJIKISTAN', 'nicename' => 'Tajikistan', 'iso3' =>762, 'numcode' => 'TJK', 'phonecode' => 992],
            [ 'iso' =>  'TZ', 'name' =>  'TANZANIA', 'nicename' =>'United Republic of Tanzania', 'iso3' =>834, 'numcode' => 'TZA', 'phonecode' => 255],
            [ 'iso' =>  'TH', 'name' =>  'THAILAND', 'nicename' => 'Thailand', 'iso3' =>764, 'numcode' => 'THA', 'phonecode' => 66],
            [ 'iso' =>  'TL', 'name' =>  'TIMOR-LESTE', 'nicename' => 'Timor-Leste', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 670],
            [ 'iso' =>  'TG', 'name' =>  'TOGO', 'nicename' => 'Togo', 'iso3' =>768, 'numcode' => 'TGO', 'phonecode' => 228],
            [ 'iso' =>  'TK', 'name' =>  'TOKELAU', 'nicename' => 'Tokelau', 'iso3' =>772, 'numcode' => 'TKL', 'phonecode' => 690],
            [ 'iso' =>  'TO', 'name' =>  'TONGA', 'nicename' => 'Tonga', 'iso3' =>776, 'numcode' => 'TON', 'phonecode' => 676],
            [ 'iso' =>  'TT', 'name' =>  'TRINIDAD AND TOBAGO', 'nicename' => 'Trinidad and Tobago', 'iso3' =>780, 'numcode' => 'TTO', 'phonecode' => 1868],
            [ 'iso' =>  'TN', 'name' =>  'TUNISIA', 'nicename' => 'Tunisia', 'iso3' =>788, 'numcode' => 'TUN', 'phonecode' => 216],
            [ 'iso' =>  'TR', 'name' =>  'TURKEY', 'nicename' => 'Turkey', 'iso3' =>792, 'numcode' => 'TUR', 'phonecode' => 90],
            [ 'iso' =>  'TM', 'name' =>  'TURKMENISTAN', 'nicename' => 'Turkmenistan', 'iso3' =>795, 'numcode' => 'TKM', 'phonecode' => 7370],
            [ 'iso' =>  'TC', 'name' =>  'TURKS AND CAICOS ISLANDS', 'nicename' => 'Turks and Caicos Islands', 'iso3' =>796, 'numcode' => 'TCA', 'phonecode' => 1649],
            [ 'iso' =>  'TV', 'name' =>  'TUVALU', 'nicename' => 'Tuvalu', 'iso3' =>798, 'numcode' => 'TUV', 'phonecode' => 688],
            [ 'iso' =>  'UG', 'name' =>  'UGANDA', 'nicename' => 'Uganda', 'iso3' =>800, 'numcode' => 'UGA', 'phonecode' => 256],
            [ 'iso' =>  'UA', 'name' =>  'UKRAINE', 'nicename' => 'Ukraine', 'iso3' =>804, 'numcode' => 'UKR', 'phonecode' => 380],
            [ 'iso' =>  'AE', 'name' =>  'UNITED ARAB EMIRATES', 'nicename' => 'United Arab Emirates', 'iso3' =>784, 'numcode' => 'ARE', 'phonecode' => 971],
            [ 'iso' =>  'GB', 'name' =>  'UNITED KINGDOM', 'nicename' => 'United Kingdom', 'iso3' =>826, 'numcode' => 'GBR', 'phonecode' => 44],
            [ 'iso' =>  'US', 'name' =>  'UNITED STATES', 'nicename' => 'United States', 'iso3' =>840, 'numcode' => 'USA', 'phonecode' => 1],
            [ 'iso' =>  'UM', 'name' =>  'UNITED STATES MINOR OUTLYING ISLANDS', 'nicename' => 'United States Minor Outlying Islands', 'iso3' => NULL, 'numcode' => NULL, 'phonecode' => 1],
            [ 'iso' =>  'UY', 'name' =>  'URUGUAY', 'nicename' => 'Uruguay', 'iso3' =>858, 'numcode' => 'URY', 'phonecode' => 598],
            [ 'iso' =>  'UZ', 'name' =>  'UZBEKISTAN', 'nicename' => 'Uzbekistan', 'iso3' =>860, 'numcode' => 'UZB', 'phonecode' => 998],
            [ 'iso' =>  'VU', 'name' =>  'VANUATU', 'nicename' => 'Vanuatu', 'iso3' =>548, 'numcode' => 'VUT', 'phonecode' => 678],
            [ 'iso' =>  'VE', 'name' =>  'VENEZUELA', 'nicename' => 'Venezuela', 'iso3' =>862, 'numcode' => 'VEN', 'phonecode' => 58],
            [ 'iso' =>  'VN', 'name' =>  'VIET NAM', 'nicename' => 'Viet Nam', 'iso3' =>704, 'numcode' => 'VNM', 'phonecode' => 84],
            [ 'iso' =>  'VG', 'name' =>  'VIRGIN ISLANDS', 'nicename' =>'Virgin Islands  British', 'iso3' =>92, 'numcode' => 'VGB', 'phonecode' => 1284],
            [ 'iso' =>  'VI', 'name' =>  'VIRGIN ISLANDS', 'nicename' =>'Virgin Islands  U.s.', 'iso3' =>850, 'numcode' => 'VIR', 'phonecode' => 1340],
            [ 'iso' =>  'WF', 'name' =>  'WALLIS AND FUTUNA', 'nicename' => 'Wallis and Futuna', 'iso3' =>876, 'numcode' => 'WLF', 'phonecode' => 681],
            [ 'iso' =>  'EH', 'name' =>  'WESTERN SAHARA', 'nicename' => 'Western Sahara', 'iso3' =>732, 'numcode' => 'ESH', 'phonecode' => 212],
            [ 'iso' =>  'YE', 'name' =>  'YEMEN', 'nicename' => 'Yemen', 'iso3' =>887, 'numcode' => 'YEM', 'phonecode' => 967],
            [ 'iso' =>  'ZM', 'name' =>  'ZAMBIA', 'nicename' => 'Zambia', 'iso3' =>894, 'numcode' => 'ZMB', 'phonecode' => 260],
            [ 'iso' =>  'ZW', 'name' =>  'ZIMBABWE', 'nicename' => 'Zimbabwe', 'iso3' =>716, 'numcode' => 'ZWE', 'phonecode' => 263],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
