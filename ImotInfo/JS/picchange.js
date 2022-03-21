var img = document.getElementById("iimg");


function changePicture()
{
    var A = convertTemp();
    img.style.display = '';    
    if (A > 50)
        {
            img.src = "http://3.bp.blogspot.com/-I5le-iONsuc/UDwY0gx6LMI/AAAAAAAAAnk/2VVq3KX7e2I/s1600/600px-Capital_C.png";
        }
        else if (A < 50 & A > 32)
        {
            img.src = "http://static.tumblr.com/148af423ee41cdb24507f372f95bd4d0/wuvn5qh/ovFmzk9sh/tumblr_static_f-word-1ha91xq.png";       
        }
            else
            {
                img.src = "http://static.tumblr.com/148af423ee41cdb24507f372f95bd4d0/wuvn5qh/ovFmzk9sh/tumblr_static_f-word-1ha91xq.png";    
            }
}