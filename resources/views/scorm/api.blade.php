<html>
<head>

    <title>VS SCORM - RTE API</title>

    <script language="javascript">

        /*

         VS SCORM - RTE API FOR SCORM 1.2
         Rev 1.0 - Sunday, May 31, 2009
         Copyright (C) 2009, Addison Robson LLC

         This program is free software; you can redistribute it and/or
         modify it under the terms of the GNU General Public License
         as published by the Free Software Foundation; either version 2
         of the License, or (at your option) any later version.

         This program is distributed in the hope that it will be useful,
         but WITHOUT ANY WARRANTY; without even the implied warranty of
         MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
         GNU General Public License for more details.

         You should have received a copy of the GNU General Public License
         along with this program; if not, write to the Free Software
         Foundation, Inc., 51 Franklin Street, Fifth Floor,
         Boston, MA  02110-1301, USA.

         */

        var debug = true;

        // ------------------------------------------
        //   SCORM RTE Functions - Initialization
        // ------------------------------------------
        function LMSInitialize(dummyString) {
            if (debug) { alert('*** LMSInitialize ***'); }
            return "true";
        }

        // ------------------------------------------
        //   SCORM RTE Functions - Getting and Setting Values
        // ------------------------------------------
        function LMSGetValue(varname) {
            /*  if (debug) {
             alert('*** LMSGetValue varname='+varname
             +' varvalue=value ***');
             }
             return "value";*/

            // create request object
            var req = createRequest();

            // set up request parameters - uses GET method
            req.open('GET','getValue.php?varname='+urlencode(varname)
                    +'&code='+Math.random(),false);

            // submit to the server for processing
            req.send(null);

            // process returned data - error condition
            if (req.status != 200) {
                alert('Problem with Request');
                return "";
            }

            // process returned data - OK
            else {
                return req.responseText;
            }
        }

        function LMSSetValue(varname,varvalue) {
            /*  if (debug) {
             alert('*** LMSSetValue varname='+varname
             +' varvalue='+varvalue+' ***');
             }
             return "true";*/

            // create request object
            var req = createRequest();

            // set up request parameters - uses combined GET and POST
            req.open('POST','setValue.php?varname='+urlencode(varname)
                    +'&code='+Math.random(),false);

            // send header information along with the POST data
            var params = 'varvalue='+urlencode(varvalue);
            req.setRequestHeader("Content-type",
                    "application/x-www-form-urlencoded");
            req.setRequestHeader("Content-length", params.length);
            req.setRequestHeader("Connection", "close");

            // submit to the server for processing
            req.send(params);

            // process returned data - error condition
            if (req.status != 200) {
                alert('Problem with Request');
                return "false";
            }

            // process returned data - OK
            else {
                return "true";
            }
        }

        function LMSCommit(dummyString) {
            if (debug) { alert('*** LMSCommit ***'); }
            return "true";
        }

        // ------------------------------------------
        //   SCORM RTE Functions - Closing The Session
        // ------------------------------------------
        function LMSFinish(dummyString) {
            if (debug) { alert('*** LMSFinish ***'); }
            return "true";
        }

        // ------------------------------------------
        //   SCORM RTE Functions - Error Handling
        // ------------------------------------------
        function LMSGetLastError() {
            if (debug) { alert('*** LMSGetLastError ***'); }
            return 0;
        }

        function LMSGetDiagnostic(errorCode) {
            if (debug) {
                alert('*** LMSGetDiagnostic errorCode='+errorCode+' ***');
            }
            return "diagnostic string";
        }

        function LMSGetErrorString(errorCode) {
            if (debug) {
                alert('*** LMSGetErrorString errorCode='+errorCode+' ***');
            }
            return "error string";
        }


        // Step 6 – Creating the AJAX Requests

        function createRequest() {

            // this is the object that we're going to (try to) create
            var request;

            // does the browser have native support for
            // the XMLHttpRequest object
            try {
                request = new XMLHttpRequest();
            }

                    // it failed so it's likely to be Internet Explorer which
                    // uses a different way to do this
            catch (tryIE) {

                // try to see if it's a newer version of Internet Explorer
                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                }

                        // that didn't work so ...
                catch (tryOlderIE) {

                    // maybe it's an older version of Internet Explorer
                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                            // even that didn't work (sigh)
                    catch (failed) {
                        alert("Error creating XMLHttpRequest");
                    }

                }
            }
            return request;
        }


        function urlencode( str ) {
            //
            // Ref: http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_urlencode/
            //
            // http://kevin.vanzonneveld.net
            // +   original by: Philip Peterson
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +      input by: AJ
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   improved by: Brett Zamir (http://brettz9.blogspot.com)
            // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +      input by: travc
            // +      input by: Brett Zamir (http://brettz9.blogspot.com)
            // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   improved by: Lars Fischer
            // %          note 1: info on what encoding functions to use from: http://xkr.us/articles/javascript/encode-compare/
            // *     example 1: urlencode('Kevin van Zonneveld!');
            // *     returns 1: 'Kevin+van+Zonneveld%21'
            // *     example 2: urlencode('http://kevin.vanzonneveld.net/');
            // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
            // *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
            // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'

            var histogram = {}, unicodeStr='', hexEscStr='';
            var ret = (str+'').toString();

            var replacer = function(search, replace, str) {
                var tmp_arr = [];
                tmp_arr = str.split(search);
                return tmp_arr.join(replace);
            };

            // The histogram is identical to the one in urldecode.
            histogram["'"]   = '%27';
            histogram['(']   = '%28';
            histogram[')']   = '%29';
            histogram['*']   = '%2A';
            histogram['~']   = '%7E';
            histogram['!']   = '%21';
            histogram['%20'] = '+';
            histogram['\u00DC'] = '%DC';
            histogram['\u00FC'] = '%FC';
            histogram['\u00C4'] = '%D4';
            histogram['\u00E4'] = '%E4';
            histogram['\u00D6'] = '%D6';
            histogram['\u00F6'] = '%F6';
            histogram['\u00DF'] = '%DF';
            histogram['\u20AC'] = '%80';
            histogram['\u0081'] = '%81';
            histogram['\u201A'] = '%82';
            histogram['\u0192'] = '%83';
            histogram['\u201E'] = '%84';
            histogram['\u2026'] = '%85';
            histogram['\u2020'] = '%86';
            histogram['\u2021'] = '%87';
            histogram['\u02C6'] = '%88';
            histogram['\u2030'] = '%89';
            histogram['\u0160'] = '%8A';
            histogram['\u2039'] = '%8B';
            histogram['\u0152'] = '%8C';
            histogram['\u008D'] = '%8D';
            histogram['\u017D'] = '%8E';
            histogram['\u008F'] = '%8F';
            histogram['\u0090'] = '%90';
            histogram['\u2018'] = '%91';
            histogram['\u2019'] = '%92';
            histogram['\u201C'] = '%93';
            histogram['\u201D'] = '%94';
            histogram['\u2022'] = '%95';
            histogram['\u2013'] = '%96';
            histogram['\u2014'] = '%97';
            histogram['\u02DC'] = '%98';
            histogram['\u2122'] = '%99';
            histogram['\u0161'] = '%9A';
            histogram['\u203A'] = '%9B';
            histogram['\u0153'] = '%9C';
            histogram['\u009D'] = '%9D';
            histogram['\u017E'] = '%9E';
            histogram['\u0178'] = '%9F';

            // Begin with encodeURIComponent, which most resembles PHP's encoding functions
            ret = encodeURIComponent(ret);

            for (unicodeStr in histogram) {
                hexEscStr = histogram[unicodeStr];
                ret = replacer(unicodeStr, hexEscStr, ret);
            }

            // Uppercase for full PHP compatibility
            return ret.replace(/(\%([a-z0-9]{2}))/g, function(full, m1, m2) {
                return "%"+m2.toUpperCase();
            });
        }

    </script>

</head>
<body>



</body>
</html>