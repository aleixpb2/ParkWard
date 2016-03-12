package com.hackit.parkward;

import android.content.Context;
import android.os.AsyncTask;
import android.os.Environment;
import android.util.Log;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpVersion;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.InputStreamEntity;
import org.apache.http.entity.mime.HttpMultipartMode;
import org.apache.http.entity.mime.MultipartEntity;
import org.apache.http.entity.mime.MultipartEntityBuilder;
import org.apache.http.entity.mime.content.ContentBody;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.entity.mime.content.StringBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeaderValueFormatter;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.CoreProtocolPNames;
import org.apache.http.params.HttpParams;
import org.apache.http.util.EntityUtils;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;

/**
 * Created by aleix on 12/03/2016.
 */
public class SendImageTask extends AsyncTask<String, Void, Boolean> {

    private static final String LOG_TAG = "SendImageTask";

    protected Boolean doInBackground(String... s) {
/*        // COPYPASTE ESTEVE
        try {
            HttpClient httpclient = new DefaultHttpClient();
            httpclient.getParams().setParameter(CoreProtocolPNames.PROTOCOL_VERSION, HttpVersion.HTTP_1_1);

            HttpPost httppost = new HttpPost("http://bestbarcelona.org/externalprojects/hackseat/server/upload.php");
            File file = new File(s[0]);
            Log.d(LOG_TAG, file.toString());
            MultipartEntity mpEntity = new MultipartEntity();
            ContentBody cbFile = new FileBody(file, "image/jpg");
            mpEntity.addPart("userfile", cbFile);

            httppost.setEntity(mpEntity);
            Log.d(LOG_TAG, "executing request " + httppost.getRequestLine());
            HttpResponse response = httpclient.execute(httppost); // CRITICAL
            HttpEntity resEntity = response.getEntity();
            Log.d(LOG_TAG, response.getStatusLine().toString());
            if (resEntity != null) {
                Log.d(LOG_TAG, EntityUtils.toString(resEntity));
            }
            if (resEntity != null) {
                resEntity.consumeContent();
            }
            httpclient.getConnectionManager().shutdown();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
        // END COPYPASTE*/

        //COPYPASTE STACK
        String url = "http://bestbarcelona.org/externalprojects/hackseat/server/upload.php";
        File file = new File(s[0]);
        try {
            HttpClient client = new DefaultHttpClient();
            HttpPost post = new HttpPost(url);

            MultipartEntityBuilder entityBuilder = MultipartEntityBuilder.create();
            entityBuilder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);

            //entityBuilder.addTextBody(USER_ID, userId);
            //entityBuilder.addTextBody(NAME, name);
            entityBuilder.addBinaryBody("userfile", file);

            HttpEntity entity = entityBuilder.build();
            post.setEntity(entity);
            HttpResponse response = client.execute(post);

            HttpEntity httpEntity = response.getEntity();
            Log.d(LOG_TAG, EntityUtils.toString(httpEntity));
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        }
        // END COPYPASTE STACK
        return true;
    }

    protected void onPostExecute(Boolean result) {
        String s;
        if(result) s = "Sent correctly";
        else s = "Not sent";
        Log.d(LOG_TAG, s);
        //TODO: delete the image
    }
}