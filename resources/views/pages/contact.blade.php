@extends('layouts.page')

@section('title', 'Contact Us — CompresslyPro | Get Help & Support')
@section('description', 'Contact the CompresslyPro team for support, feedback, or business enquiries. We respond to every message within 24 hours.')
@section('canonical', url('/contact'))
@section('og_title', 'Contact CompresslyPro — Support & Feedback')
@section('og_description', 'Have a question about CompresslyPro? Contact our team for support, feature requests, or business enquiries.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">Contact Us</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "Contact CompresslyPro",
    "description": "Get in touch with the CompresslyPro team for support, feedback, or business enquiries.",
    "url": "https://compresslypro.com/contact",
    "mainEntity": {
        "@type": "Organization",
        "name": "CompresslyPro",
        "url": "https://compresslypro.com",
        "email": "support@compresslypro.com",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "contactType": "customer support",
                "email": "support@compresslypro.com",
                "availableLanguage": "English"
            },
            {
                "@type": "ContactPoint",
                "contactType": "sales",
                "email": "business@compresslypro.com",
                "availableLanguage": "English"
            }
        ]
    }
}
</script>
@endverbatim
@endsection

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Header --}}
    <div class="mb-12 text-center">
        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">Get in Touch</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">Contact <span class="gradient-text">Us</span></h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Have a question, feature request, or found a bug? We'd love to hear from you. Our team reads and responds to every message.
        </p>
    </div>

    {{-- Contact Cards --}}
    <div class="grid sm:grid-cols-3 gap-5 mb-12">
        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
            <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Email Support</h3>
            <p class="text-sm text-gray-500 mb-3">For general questions, feedback, and support requests.</p>
            <a href="mailto:support@compresslypro.com" class="text-brand-600 font-semibold text-sm hover:text-brand-800 transition-colors">support@compresslypro.com</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Feature Requests</h3>
            <p class="text-sm text-gray-500 mb-3">Have an idea for a new tool or feature improvement?</p>
            <a href="mailto:feedback@compresslypro.com" class="text-purple-600 font-semibold text-sm hover:text-purple-800 transition-colors">feedback@compresslypro.com</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
            <div class="w-14 h-14 bg-accent-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-accent-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Business Enquiries</h3>
            <p class="text-sm text-gray-500 mb-3">Partnerships, advertising, or enterprise solutions.</p>
            <a href="mailto:business@compresslypro.com" class="text-accent-600 font-semibold text-sm hover:text-accent-800 transition-colors">business@compresslypro.com</a>
        </div>
    </div>

    {{-- FAQ / Common Questions --}}
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>Frequently Asked Questions</h2>

            <h3>How quickly do you respond?</h3>
            <p>
                We aim to respond to all emails within <strong>24 hours</strong> on business days. For urgent technical issues (e.g., the site is down), we prioritise those messages and typically respond within a few hours.
            </p>

            <h3>I found a bug — how do I report it?</h3>
            <p>
                Please send an email to <a href="mailto:support@compresslypro.com">support@compresslypro.com</a> with the following details:
            </p>
            <ul>
                <li>What you were trying to do (e.g., "compress a 5MB PNG image")</li>
                <li>What happened (e.g., "got an error message saying 'processing failed'")</li>
                <li>Your browser and device (e.g., "Chrome on Windows 11" or "Safari on iPhone 15")</li>
                <li>A screenshot of the error, if possible</li>
            </ul>
            <p>This helps us reproduce and fix the issue as quickly as possible.</p>

            <h3>Can I request a new feature?</h3>
            <p>
                Absolutely! We love hearing from users. Send your feature ideas to <a href="mailto:feedback@compresslypro.com">feedback@compresslypro.com</a>. Many of our current features — including batch compression, watermarking, and PDF tools — were built based on user requests.
            </p>

            <h3>Do you offer an API or enterprise plan?</h3>
            <p>
                We're exploring API access and enterprise plans for businesses that need high-volume image processing. If you're interested, please email <a href="mailto:business@compresslypro.com">business@compresslypro.com</a> with details about your use case and expected volume.
            </p>

            <h3>I have a privacy or data concern</h3>
            <p>
                We take privacy very seriously. All uploaded files are automatically deleted within 30 minutes and are never shared or analysed. For specific privacy questions, please review our <a href="/privacy-policy">Privacy Policy</a> or email <a href="mailto:privacy@compresslypro.com">privacy@compresslypro.com</a>.
            </p>
        </div>
    </div>

    {{-- Response Time Commitment --}}
    <div class="bg-gradient-to-br from-brand-50 to-white rounded-2xl border border-brand-100 p-8 text-center">
        <div class="w-16 h-16 bg-brand-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-2xl font-extrabold mb-2">Our Response Commitment</h2>
        <p class="text-gray-500 max-w-lg mx-auto mb-4">
            We believe every message deserves a thoughtful response. Our team personally reads and replies to every email — no auto-responders, no ticket queues, just real people helping real users.
        </p>
        <div class="flex justify-center gap-6 text-sm">
            <div>
                <div class="font-bold text-brand-700 text-lg">< 24h</div>
                <div class="text-gray-400">Average response</div>
            </div>
            <div class="w-px bg-gray-200"></div>
            <div>
                <div class="font-bold text-brand-700 text-lg">100%</div>
                <div class="text-gray-400">Reply rate</div>
            </div>
            <div class="w-px bg-gray-200"></div>
            <div>
                <div class="font-bold text-brand-700 text-lg">English</div>
                <div class="text-gray-400">Language</div>
            </div>
        </div>
    </div>
</article>
@endsection
