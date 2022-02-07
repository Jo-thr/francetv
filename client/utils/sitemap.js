import axios from 'axios'

export const fetchSitemapRoutes = async () => {
  try {
    const axiosBaseURL = process.env.BASE_URL
    const routes = []

    //   Topics
    const topics = await axios.get(`${axiosBaseURL}/headings`)
    topics.data.data.forEach((topic) => {
      routes.push(`/topics/${topic.meta.slug.fr}`)
      routes.push(`/en/topics/${topic.meta.slug.en}`)
    })

    // Posts
    const postsData = await axios.get(`${axiosBaseURL}/posts`)
    const allPostsData = []

    postsData.data.data.forEach((element) => allPostsData.push(element))

    if (postsData.data.meta.last_page > 1) {
      for (let index = 2; index <= postsData.data.meta.last_page; index++) {
        const postsDataPerPage = await axios.get(`${axiosBaseURL}/posts`, {
          params: { page: index },
        })
        postsDataPerPage.data.data.forEach((element) =>
          allPostsData.push(element)
        )
      }
    }

    allPostsData.forEach((post) => {
      routes.push(`/articles/${post.meta.slug.fr}`)
      routes.push(`/en/posts/${post.meta.slug.en}`)
    })

    // Tests
    const testsData = await axios.get(`${axiosBaseURL}/tests`)
    const allTestsData = []

    testsData.data.data.forEach((element) => allTestsData.push(element))

    if (testsData.data.meta.last_page > 1) {
      for (let index = 2; index <= testsData.data.meta.last_page; index++) {
        const testsDataPerPage = await axios.get(`${axiosBaseURL}/tests`, {
          params: { page: index },
        })
        testsDataPerPage.data.data.forEach((element) =>
          allTestsData.push(element)
        )
      }
    }

    allTestsData.forEach((test) => {
      routes.push(`/tests/${test.meta.slug.fr}`)
      routes.push(`/en/tests/${test.meta.slug.en}`)
    })

    // Tags
    const tagsData = await axios.get(`${axiosBaseURL}/tags`)
    const allTagsData = []

    tagsData.data.data.forEach((element) => allTagsData.push(element))

    if (tagsData.data.meta.last_page > 1) {
      for (let index = 2; index <= tagsData.data.meta.last_page; index++) {
        const tagsDataPerPage = await axios.get(`${axiosBaseURL}/tags`, {
          params: { page: index },
        })
        tagsDataPerPage.data.data.forEach((element) =>
          allTagsData.push(element)
        )
      }
    }

    allTagsData.forEach((tag) => {
      routes.push(`/tags/${tag.meta.slug.fr}`)
      routes.push(`/en/tags/${tag.meta.slug.en}`)
    })

    return routes
  } catch (error) {
    // eslint-disable-next-line no-console
    console.error(
      'Unable to contact the API to generate the dynamic routes of the Sitemap : ',
      error
    )
  }
}
