$(document).ready(function () {
    let team_path = $('#teams_path').val()
    $.ajax({
        url: '/websites/team-lists',
        type: 'get',
        success: function (res) {
            if (res.data) {
                $.each(res.data, function (k, v) {
                    if (v.twitter_url === null) v.twitter_url = '#'
                    if (v.facebook_url === null) v.facebook_url = '#'
                    if (v.instagram_url === null) v.instagram_url = '#'
                    if (v.linkedin_url === null) v.linkedin_url = '#'
                    $('#teams-list').append(`
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="90">
                            <div class="member-img">
                                <img src="${team_path+'/'+v.image}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="${v.twitter_url}" target="_blank"><i class="icofont-twitter"></i></a>
                                    <a href="${v.facebook_url}" target="_blank"><i class="icofont-facebook"></i></a>
                                    <a href="${v.instagram_url}" target="_blank"><i class="icofont-instagram"></i></a>
                                    <a href="${v.linkedin_url}" target="_blank"><i class="icofont-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>${v.name}</h4>
                                <span>${v.designation}</span>
                            </div>
                        </div>
                    </div>
                    `)
                })
            }
        }
    })
})